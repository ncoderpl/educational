(function() {
    'use strict';

    var content = document.getElementById('docContent');

    /* ---------- Spis treści + kotwice ---------- */
    var toc = document.getElementById('hxToc');
    if (content && toc) {
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

            var a = document.createElement('a');
            a.href = '#' + h.id;
            a.className = 'hx-anchor';
            a.textContent = '#';
            h.appendChild(a);

            var li = document.createElement('li');
            var l = document.createElement('a');
            l.href = '#' + h.id;
            l.className = h.tagName === 'H3' ? 'lvl3' : 'lvl2';
            l.textContent = h.firstChild.textContent;
            li.appendChild(l);
            toc.appendChild(li);
        });

        if (!heads.length) {
            var aside = toc.closest('.hx-toc');
            if (aside) aside.style.visibility = 'hidden';
        }

        /* scrollspy */
        var links = toc.querySelectorAll('a');
        if ('IntersectionObserver' in window && heads.length) {
            var io = new IntersectionObserver(function(entries) {
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
            heads.forEach(function(h) { io.observe(h); });
        }
    }

    /* ---------- Nawigacja boczna: pokaż aktywną pozycję ---------- */
    (function() {
        var act = document.querySelector('#hxNav .hx-nav-link.active');
        var body = document.querySelector('#hxSidebar .offcanvas-body');
        if (act && body && body.scrollHeight > body.clientHeight) {
            var r = act.getBoundingClientRect(),
                b = body.getBoundingClientRect();
            if (r.top < b.top || r.bottom > b.bottom) {
                body.scrollTop += (r.top - b.top) - body.clientHeight / 3;
            }
        }
        var sb = document.getElementById('hxSidebar');
        if (sb) sb.addEventListener('shown.bs.offcanvas', function() {
            var a = document.querySelector('#hxNav .hx-nav-link.active');
            if (a) a.scrollIntoView({ block: 'center' });
        });
    })();

    /* ---------- Przełącznik jasny / ciemny ---------- */
    var tg = document.getElementById('hxThemeToggle');
    if (tg) {
        tg.addEventListener('click', function() {
            var root = document.documentElement;
            var next = root.getAttribute('data-bs-theme') === 'light' ? 'dark' : 'light';
            root.setAttribute('data-bs-theme', next);
            try { localStorage.setItem('hx-theme', next); } catch (e) {}
        });
    }

    /* ---------- Przycisk "Kopiuj" i etykieta języka w blokach kodu ---------- */
    document.querySelectorAll('.doc-content pre').forEach(function(pre) {
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

    /* ---------- Wyszukiwarka (po menu nawigacji) ---------- */
    var input = document.getElementById('hxSearch');
    var box = document.getElementById('hxSearchResults');
    if (input && box) {
        var index = [];
        document.querySelectorAll('#hxNav .hx-nav-link').forEach(function(a) {
            var group = a.closest('.hx-nav-group');
            var title = group ? group.querySelector('.hx-nav-title').textContent : '';
            index.push({ title: a.textContent.trim(), url: a.getAttribute('href'), group: title });
        });

        var sel = -1;

        function render(q) {
            q = q.trim().toLowerCase();
            if (!q) { box.classList.add('d-none'); return; }
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
        input.addEventListener('input', function() { render(input.value); });
        input.addEventListener('keydown', function(e) {
            var items = box.querySelectorAll('a');
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                if (!items.length) return;
                sel = (sel + (e.key === 'ArrowDown' ? 1 : -1) + items.length) % items.length;
                items.forEach(function(x, i) { x.classList.toggle('sel', i === sel); });
            } else if (e.key === 'Enter' && items.length) {
                window.location.href = items[Math.max(sel, 0)].href;
            } else if (e.key === 'Escape') {
                box.classList.add('d-none');
                input.blur();
            }
        });
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.hx-search')) box.classList.add('d-none');
        });
        document.addEventListener('keydown', function(e) {
            if ((e.key === 'k' && (e.ctrlKey || e.metaKey))) {
                e.preventDefault();
                input.focus();
                input.select();
                return;
            }
            if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                e.preventDefault();
                input.focus();
            }
        });
    }
})();