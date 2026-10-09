(function() {
    'use strict';

    // Funkcja inicjująca elementy dynamiczne - uruchamiana na start i po każdym przejściu HTMX
    function initEduTheme() {
        var content = document.getElementById('docContent');

        /* ---------- Spis treści + kotwice ---------- */
        var toc = document.getElementById('hxToc');
        if (content && toc) {
            toc.innerHTML = ''; // Wyczyszczenie przed wygenerowaniem nowego
            var heads = content.querySelectorAll('h2, h3');
            var used = {};
            heads.forEach(function(h) {
                if (!h.id) {
                    var id = h.textContent.trim().toLowerCase()
                        .replace(/ł/g, 'l')
                        .normalize('NFD').replace(/[̀-ͯ]/g, '')
                        .replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '') || 'sekcja';
                    var base = id,
                        n = 2;
                    while (used[id]) { id = base + '-' + n++; }
                    h.id = id;
                }
                used[h.id] = true;

                if (!h.querySelector('.hx-anchor')) {
                    var a = document.createElement('a');
                    a.href = '#' + h.id;
                    a.className = 'hx-anchor';
                    a.textContent = '#';
                    h.appendChild(a);
                }

                var li = document.createElement('li');
                var l = document.createElement('a');
                l.href = '#' + h.id;
                l.className = h.tagName === 'H3' ? 'lvl3' : 'lvl2';
                l.textContent = (h.firstChild ? h.firstChild.textContent : h.textContent).replace('#', '').trim();
                li.appendChild(l);
                toc.appendChild(li);
            });

            var aside = toc.closest('.hx-toc');
            if (aside) aside.style.visibility = heads.length ? 'visible' : 'hidden';

            /* scrollspy */
            var links = toc.querySelectorAll('a');
            if ('IntersectionObserver' in window && heads.length) {
                if (window.__hxScrollObserver) window.__hxScrollObserver.disconnect();

                window.__hxScrollObserver = new IntersectionObserver(function(entries) {
                    entries.forEach(function(e) {
                        if (e.isIntersecting) {
                            links.forEach(function(x) { x.classList.remove('active'); });
                            var cur = toc.querySelector('a[href="#' + e.target.id + '"]');
                            if (cur) {
                                cur.classList.add('active');
                                var box = toc.closest('.hx-toc-inner');
                                if (box) {
                                    var top = cur.offsetTop - toc.offsetTop;
                                    if (top < box.scrollTop + 20 || top > box.scrollTop + box.clientHeight - 40) {
                                        box.scrollTop = top - box.clientHeight / 3;
                                    }
                                }
                            }
                        }
                    });
                }, { rootMargin: '-70px 0px -70% 0px' });
                heads.forEach(function(h) { window.__hxScrollObserver.observe(h); });
            }
        }

        /* ---------- Nawigacja boczna: pokaż aktywną pozycję ---------- */
        var act = document.querySelector('#hxNav .hx-nav-link.active');
        var body = document.querySelector('#hxSidebar .offcanvas-body');
        if (act && body && body.scrollHeight > body.clientHeight) {
            var r = act.getBoundingClientRect(),
                b = body.getBoundingClientRect();
            if (r.top < b.top || r.bottom > b.bottom) {
                body.scrollTop += (r.top - b.top) - body.clientHeight / 3;
            }
        }

        /* ---------- Przycisk "Kopiuj" i etykieta języka w blokach kodu ---------- */
        document.querySelectorAll('.doc-content pre').forEach(function(pre) {
            if (pre.classList.contains('has-copy-btn')) return; // Zapobiega duplikatom
            pre.classList.add('has-copy-btn');

            var codeEl = pre.querySelector('code');
            var m = codeEl && /(?:language|lang)-([\w+#-]+)/.exec(codeEl.className + ' ' + pre.className);
            if (m) {
                var lab = document.createElement('span');
                lab.className = 'hx-lang';
                lab.textContent = m[1];
                pre.classList.add('has-lang');
                pre.appendChild(lab);
            }
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'hx-copy';
            btn.textContent = 'Kopiuj';
            btn.addEventListener('click', function() {
                var code = pre.querySelector('code');
                var text = (code || pre).innerText;
                var done = function() {
                    btn.textContent = 'Skopiowano';
                    setTimeout(function() { btn.textContent = 'Kopiuj'; }, 1500);
                };
                if (navigator.clipboard) navigator.clipboard.writeText(text).then(done);
            });
            pre.appendChild(btn);
        });

        /* ---------- Wyszukiwarka (odświeżanie indeksu) ---------- */
        window.__hxSearchIndex = [];
        document.querySelectorAll('.hx-nav-link').forEach(function(a) {
            var group = a.closest('.hx-nav-group');
            var titleGroup = group ? group.querySelector('.hx-nav-title') : null;
            var title = titleGroup ? titleGroup.textContent : '';
            window.__hxSearchIndex.push({ title: a.textContent.trim(), url: a.getAttribute('href'), group: title });
        });
    }

    // ==========================================
    // ZDARZENIA GŁÓWNE (Bindowane bezwzględnie RAZ w obiekcie globalnym)
    // ==========================================
    if (!window.__eduThemeEventsBound) {
        window.__eduThemeEventsBound = true;

        // Zintegrowanie z HTMX
        document.addEventListener('DOMContentLoaded', initEduTheme);
        document.addEventListener('htmx:afterSwap', initEduTheme);

        // Wywołanie ratunkowe
        if (document.readyState === 'interactive' || document.readyState === 'complete') {
            initEduTheme();
        }

        /* ---------- Przełącznik jasny / ciemny (Globalna delegacja) ---------- */
        document.addEventListener('click', function(e) {
            var tg = e.target.closest('#hxThemeToggle');
            if (tg) {
                var root = document.documentElement;
                var next = root.getAttribute('data-bs-theme') === 'light' ? 'dark' : 'light';
                root.setAttribute('data-bs-theme', next);
                try { localStorage.setItem('hx-theme', next); } catch (err) {}
            }
        });

        /* ---------- Wyszukiwarka - Logika i delegacja zdarzeń ---------- */
        var sel = -1;

        function renderSearch(q) {
            var box = document.getElementById('hxSearchResults');
            if (!box) return;
            q = q.trim().toLowerCase();
            if (!q) { box.classList.add('d-none'); return; }

            var index = window.__hxSearchIndex || [];
            var hits = index.filter(function(i) {
                return (i.title + ' ' + i.group).toLowerCase().indexOf(q) !== -1;
            }).slice(0, 8);

            box.innerHTML = '';
            if (!hits.length) {
                box.innerHTML = '<div class="hx-search-empty">Brak wyników</div>';
            }
            hits.forEach(function(h) {
                var a = document.createElement('a');
                a.href = h.url;
                a.innerHTML = '<span></span><small></small>';
                a.firstChild.textContent = h.title;
                a.lastChild.textContent = h.group;
                box.appendChild(a);
            });
            sel = -1;
            box.classList.remove('d-none');
        }

        // Delegacja na cały dokument - HTMX niczego nie zepsuje
        document.addEventListener('input', function(e) {
            if (e.target && e.target.id === 'hxSearch') {
                renderSearch(e.target.value);
            }
        });

        document.addEventListener('keydown', function(e) {
            var input = document.getElementById('hxSearch');
            var box = document.getElementById('hxSearchResults');

            if ((e.key === 'k' && (e.ctrlKey || e.metaKey))) {
                e.preventDefault();
                if (input) { input.focus();
                    input.select(); }
                return;
            }

            if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                e.preventDefault();
                if (input) input.focus();
                return;
            }

            if (e.target === input && box) {
                var items = box.querySelectorAll('a');
                if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                    e.preventDefault();
                    if (!items.length) return;
                    sel = (sel + (e.key === 'ArrowDown' ? 1 : -1) + items.length) % items.length;
                    items.forEach(function(x, i) { x.classList.toggle('sel', i === sel); });
                } else if (e.key === 'Enter' && items.length) {
                    e.preventDefault();
                    var targetLink = items[Math.max(sel, 0)];

                    // Sprzątanie szukajki przed skokiem
                    input.value = '';
                    box.classList.add('d-none');
                    input.blur();

                    // SPA Routing - ładujemy wynik przez HTMX
                    if (window.htmx) {
                        window.htmx.ajax('GET', targetLink.href, { target: 'body' });
                    } else {
                        window.location.href = targetLink.href;
                    }
                } else if (e.key === 'Escape') {
                    box.classList.add('d-none');
                    input.blur();
                }
            }
        });

        document.addEventListener('click', function(e) {
            var box = document.getElementById('hxSearchResults');
            if (box && !e.target.closest('.hx-search')) {
                box.classList.add('d-none');
            }
        });

        // Nasłuchiwanie paska bocznego na poziomie dokumentu
        document.addEventListener('shown.bs.offcanvas', function(e) {
            if (e.target && e.target.id === 'hxSidebar') {
                var a = document.querySelector('#hxNav .hx-nav-link.active');
                if (a) a.scrollIntoView({ block: 'center' });
            }
        });
    }
})();