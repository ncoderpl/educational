<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\MacroNamespace;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Sandbox\SecurityNotAllowedTestError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* partials/base.html.twig */
class __TwigTemplate_57410e8fb27a97c1c93f19fa0e9f11e3_sourced extends Template
{
    private Source $source;
    /**
     * @var array<string, MacroNamespace>
     */
    private array $macros = [];
    private \Twig\Runtime\EscaperRuntime $escaper;

    public function __construct(Environment $env)
    {
        $this->sandbox = $env->getExtension(SandboxExtension::class)->getChecker();
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->escaper = $env->getRuntime('Twig\Runtime\EscaperRuntime');

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"";
        // line 2
        yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "language", [], "any", false, false, false, 2), "getActive", [], "any", false, false, false, 2)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "language", [], "any", false, false, false, 2), "getActive", [], "any", false, false, false, 2), "html", null, true)) : ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "config", [], "any", false, false, false, 2), "site", [], "any", false, false, false, 2), "default_lang", [], "any", false, false, false, 2), "html", null, true)));
        yield "\" data-bs-theme=\"dark\">
    <head>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"theme-color\" content=\"#15151A\">
        <title>";
        // line 7
        if (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, false, 7)) && $tmp instanceof Markup ? (string) $tmp : $tmp) &&  !(($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "home", [], "any", false, false, false, 7)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, false, 7));
            yield " | ";
        }
        yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["site"] ?? null), "title", [], "any", false, false, false, 7));
        yield "</title>
        ";
        // line 8
        yield from $this->load("partials/metadata.html.twig", 8)->unwrap()->yield($context);
        // line 9
        yield "        <script>
            /* Motyw ustawiany przed renderowaniem, żeby uniknąć mignięcia */
            (function () {
                var t = null;
                try {
                    t = localStorage.getItem(\"hx-theme\");
                } catch (e) {}
                if (!t)
                    t =
                        window.matchMedia &&
                        window.matchMedia(\"(prefers-color-scheme: light)\").matches
                            ? \"light\"
                            : \"dark\";
                document.documentElement.setAttribute(\"data-bs-theme\", t);
            })();
        </script>
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
        <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap\" rel=\"stylesheet\">
        <link href=\"";
        // line 27
        yield (string) $this->escaper->escape($this->extensions['Grav\Common\Twig\Extension\GravExtension']->urlFunc("theme://css/theme.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
        <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/katex@0.16.10/dist/katex.min.css\">
    </head>
    <body>

        <header class=\"hx-topbar sticky-top\">
            <div class=\"hx-topbar-inner d-flex align-items-center gap-2 gap-lg-3 px-3 px-lg-4\">
                <button class=\"btn btn-sm hx-icon-btn d-lg-none\" type=\"button\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#hxSidebar\" aria-label=\"Menu\">
                    <span class=\"hx-burger\"></span>
                </button>
                <a class=\"hx-brand\" href=\"";
        // line 37
        yield (string) (((($context["base_url"] ?? null) == "")) ? ("/") : ($this->escaper->escape(($context["base_url"] ?? null), "html", null, true)));
        yield "\">
                    <span class=\"hx-logo\"></span><span class=\"d-none d-sm-inline\">";
        // line 38
        yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["site"] ?? null), "title", [], "any", false, false, false, 38), "html", null, true);
        yield "</span>
                </a>

                ";
        // line 41
        $context["versions"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "theme", [], "any", false, false, false, 41), "versions", [], "any", false, false, false, 41);
        // line 42
        yield "                ";
        if (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "theme", [], "any", false, false, false, 42), "current_version", [], "any", false, false, false, 42)) && $tmp instanceof Markup ? (string) $tmp : $tmp) || (($tmp = ($context["versions"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
            // line 43
            yield "                    <div class=\"dropdown\">
                        <button class=\"btn btn-sm hx-version dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                            ";
            // line 45
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "theme", [], "any", false, false, false, 45), "current_version", [], "any", false, false, false, 45)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "theme", [], "any", false, false, false, 45), "current_version", [], "any", false, false, false, 45), "html", null, true)) : ("Wersja"));
            yield "
                        </button>
                        ";
            // line 47
            if ((($tmp = ($context["versions"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 48
                yield "                            <ul class=\"dropdown-menu hx-dropdown\">
                                ";
                // line 49
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["versions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
                    // line 50
                    yield "                                    <li><a class=\"dropdown-item\" href=\"";
                    yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["v"], "url", [], "any", false, false, false, 50), "html", null, true);
                    yield "\">";
                    yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["v"], "title", [], "any", false, false, false, 50), "html", null, true);
                    yield "</a></li>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['v'], $context['_parent']);
                $context = array_intersect_key($context, $_parent);
                $context += $_parent;
                // line 52
                yield "                            </ul>
                        ";
            }
            // line 54
            yield "                    </div>
                ";
        }
        // line 56
        yield "
                <div class=\"hx-search ms-lg-3 flex-grow-1\">
                    <input id=\"hxSearch\" type=\"search\" class=\"form-control form-control-sm\" placeholder=\"Szukaj w dokumentacji…\" autocomplete=\"off\" aria-label=\"Szukaj\">
                    <span class=\"hx-kbd d-none d-md-inline\"><kbd>Ctrl</kbd><kbd>K</kbd></span>
                    <div id=\"hxSearchResults\" class=\"hx-search-results d-none\"></div>
                </div>

                <nav class=\"d-none d-md-flex align-items-center gap-3 ms-auto\">
                    ";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "theme", [], "any", false, false, false, 64), "header_links", [], "any", false, false, false, 64));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 65
            yield "                        <a class=\"hx-toplink\" href=\"";
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["link"], "url", [], "any", false, false, false, 65), "html", null, true);
            yield "\"";
            if ((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, $context["link"], "url", [], "any", false, false, false, 65)) && is_string($_v1 = "http") && str_starts_with($_v0, $_v1))) {
                yield " target=\"_blank\" rel=\"noopener\"";
            }
            yield ">";
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["link"], "title", [], "any", false, false, false, 65), "html", null, true);
            yield "</a>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['link'], $context['_parent']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 67
        yield "                </nav>

                <div class=\"d-flex align-items-center gap-2 ms-auto ms-md-0\">
                    <button id=\"hxThemeToggle\" class=\"btn btn-sm hx-icon-btn\" type=\"button\" aria-label=\"Przełącz motyw jasny/ciemny\" title=\"Jasny / ciemny\">
                        <svg class=\"hx-ico-moon\" width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z\"/></svg>
                        <svg class=\"hx-ico-sun\" width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"12\" r=\"4\"/><path d=\"M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4\"/></svg>
                    </button>

                    ";
        // line 76
        yield "                    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 76), "authenticated", [], "any", false, false, false, 76)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 77
            yield "                        <a class=\"btn btn-sm hx-icon-btn d-inline-flex align-items-center justify-content-center\"
                           href=\"";
            // line 78
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["uri"] ?? null), "addNonce", [((((($context["base_url_relative"] ?? null) . CoreExtension::getAttribute($this->env, $this->source, ($context["uri"] ?? null), "path", [], "any", false, false, false, 78)) . "/task") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "system", [], "any", false, false, false, 78), "param_sep", [], "any", false, false, false, 78)) . "login.logout"), "logout-form", "logout-nonce"], "method", false, false, false, 78), "html", null, true);
            yield "\"
                           title=\"Wyloguj (";
            // line 79
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 79), "fullname", [], "any", false, false, false, 79)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 79), "fullname", [], "any", false, false, false, 79), "html", null, true)) : ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 79), "username", [], "any", false, false, false, 79), "html", null, true)));
            yield ")\"
                           aria-label=\"Wyloguj się\">
                            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                <path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"></path>
                                <polyline points=\"16 17 21 12 16 7\"></polyline>
                                <line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"></line>
                            </svg>
                        </a>
                    ";
        }
        // line 88
        yield "                </div>
            </div>
        </header>

        ";
        // line 92
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 93
        yield "
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js\"></script>
        <script src=\"";
        // line 95
        yield (string) $this->escaper->escape($this->extensions['Grav\Common\Twig\Extension\GravExtension']->urlFunc("theme://js/theme.js"), "html", null, true);
        yield "\"></script>
        <script defer src=\"https://cdn.jsdelivr.net/npm/katex@0.16.10/dist/katex.min.js\"></script>
        <script>
            document.addEventListener(\"DOMContentLoaded\", function () {
                // Wyszukaj wszystkie elementy z atrybutem data-m
                document.querySelectorAll(\"[data-m]\").forEach(function (el) {
                    var tex = el.getAttribute(\"data-m\");
                    if (tex) {
                        katex.render(tex, el, {
                            displayMode: true, // true dla wyśrodkowanego bloku wzoru
                            throwOnError: false,
                        });
                    }
                });
            });
        </script>
    </body>
</html>";
        return; yield;
    }

    // line 92
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/base.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDefaultEscapeStrategy(): string|false
    {
        return "html";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  253 => 92,  230 => 95,  226 => 93,  224 => 92,  218 => 88,  206 => 79,  202 => 78,  199 => 77,  196 => 76,  186 => 67,  170 => 65,  166 => 64,  156 => 56,  152 => 54,  148 => 52,  136 => 50,  132 => 49,  129 => 48,  127 => 47,  122 => 45,  118 => 43,  115 => 42,  113 => 41,  107 => 38,  103 => 37,  90 => 27,  70 => 9,  68 => 8,  60 => 7,  52 => 2,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"{{ grav.language.getActive ?: grav.config.site.default_lang }}\" data-bs-theme=\"dark\">
    <head>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"theme-color\" content=\"#15151A\">
        <title>{% if page.title and not page.home %}{{ page.title|e }} | {% endif %}{{ site.title|e }}</title>
        {% include \x27partials/metadata.html.twig\x27 %}
        <script>
            /* Motyw ustawiany przed renderowaniem, żeby uniknąć mignięcia */
            (function () {
                var t = null;
                try {
                    t = localStorage.getItem(\"hx-theme\");
                } catch (e) {}
                if (!t)
                    t =
                        window.matchMedia &&
                        window.matchMedia(\"(prefers-color-scheme: light)\").matches
                            ? \"light\"
                            : \"dark\";
                document.documentElement.setAttribute(\"data-bs-theme\", t);
            })();
        </script>
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
        <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap\" rel=\"stylesheet\">
        <link href=\"{{ url(\x27theme://css/theme.css\x27) }}\" rel=\"stylesheet\">
        <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/katex@0.16.10/dist/katex.min.css\">
    </head>
    <body>

        <header class=\"hx-topbar sticky-top\">
            <div class=\"hx-topbar-inner d-flex align-items-center gap-2 gap-lg-3 px-3 px-lg-4\">
                <button class=\"btn btn-sm hx-icon-btn d-lg-none\" type=\"button\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#hxSidebar\" aria-label=\"Menu\">
                    <span class=\"hx-burger\"></span>
                </button>
                <a class=\"hx-brand\" href=\"{{ base_url == \x27\x27 ? \x27/\x27 : base_url }}\">
                    <span class=\"hx-logo\"></span><span class=\"d-none d-sm-inline\">{{ site.title }}</span>
                </a>

                {% set versions = config.theme.versions %}
                {% if config.theme.current_version or versions %}
                    <div class=\"dropdown\">
                        <button class=\"btn btn-sm hx-version dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                            {{ config.theme.current_version ?: \x27Wersja\x27 }}
                        </button>
                        {% if versions %}
                            <ul class=\"dropdown-menu hx-dropdown\">
                                {% for v in versions %}
                                    <li><a class=\"dropdown-item\" href=\"{{ v.url }}\">{{ v.title }}</a></li>
                                {% endfor %}
                            </ul>
                        {% endif %}
                    </div>
                {% endif %}

                <div class=\"hx-search ms-lg-3 flex-grow-1\">
                    <input id=\"hxSearch\" type=\"search\" class=\"form-control form-control-sm\" placeholder=\"Szukaj w dokumentacji…\" autocomplete=\"off\" aria-label=\"Szukaj\">
                    <span class=\"hx-kbd d-none d-md-inline\"><kbd>Ctrl</kbd><kbd>K</kbd></span>
                    <div id=\"hxSearchResults\" class=\"hx-search-results d-none\"></div>
                </div>

                <nav class=\"d-none d-md-flex align-items-center gap-3 ms-auto\">
                    {% for link in config.theme.header_links %}
                        <a class=\"hx-toplink\" href=\"{{ link.url }}\"{% if link.url starts with \x27http\x27 %} target=\"_blank\" rel=\"noopener\"{% endif %}>{{ link.title }}</a>
                    {% endfor %}
                </nav>

                <div class=\"d-flex align-items-center gap-2 ms-auto ms-md-0\">
                    <button id=\"hxThemeToggle\" class=\"btn btn-sm hx-icon-btn\" type=\"button\" aria-label=\"Przełącz motyw jasny/ciemny\" title=\"Jasny / ciemny\">
                        <svg class=\"hx-ico-moon\" width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z\"/></svg>
                        <svg class=\"hx-ico-sun\" width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"12\" r=\"4\"/><path d=\"M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4\"/></svg>
                    </button>

                    {# Przycisk wylogowania widoczny tylko dla zalogowanych #}
                    {% if grav.user.authenticated %}
                        <a class=\"btn btn-sm hx-icon-btn d-inline-flex align-items-center justify-content-center\"
                           href=\"{{ uri.addNonce(base_url_relative ~ uri.path ~ \x27/task\x27 ~ config.system.param_sep ~ \x27login.logout\x27, \x27logout-form\x27, \x27logout-nonce\x27) }}\"
                           title=\"Wyloguj ({{ grav.user.fullname ?: grav.user.username }})\"
                           aria-label=\"Wyloguj się\">
                            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                <path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"></path>
                                <polyline points=\"16 17 21 12 16 7\"></polyline>
                                <line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"></line>
                            </svg>
                        </a>
                    {% endif %}
                </div>
            </div>
        </header>

        {% block body %}{% endblock %}

        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js\"></script>
        <script src=\"{{ url(\x27theme://js/theme.js\x27) }}\"></script>
        <script defer src=\"https://cdn.jsdelivr.net/npm/katex@0.16.10/dist/katex.min.js\"></script>
        <script>
            document.addEventListener(\"DOMContentLoaded\", function () {
                // Wyszukaj wszystkie elementy z atrybutem data-m
                document.querySelectorAll(\"[data-m]\").forEach(function (el) {
                    var tex = el.getAttribute(\"data-m\");
                    if (tex) {
                        katex.render(tex, el, {
                            displayMode: true, // true dla wyśrodkowanego bloku wzoru
                            throwOnError: false,
                        });
                    }
                });
            });
        </script>
    </body>
</html>", "partials/base.html.twig", "/var/www/html/user/themes/helios-bs/templates/partials/base.html.twig");
    }
    
    public function ensureSecurityCheckedOrHandOver(): ?\Twig\Template
    {
        if (!$this->sandbox->isSandboxed()) {
            return null;
        }

        return $this->loadSecurityCheckedTemplate() ?? throw new \Twig\Sandbox\SecurityError(\sprintf('Template "%s" was loaded as a trusted template and cannot be rendered while the sandbox is enabled.', $this->getTemplateName()), -1, $this->source);
    }
    
    public function ensureSecurityChecked(): void
    {
        if ($this->sandbox->isSandboxed()) {
            throw new \Twig\Sandbox\SecurityError(\sprintf('Template "%s" was loaded as a trusted template and cannot be rendered while the sandbox is enabled.', $this->getTemplateName()), -1, $this->source);
        }
    }
}
