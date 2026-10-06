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

/* chapter.html.twig */
class __TwigTemplate_e6b25fc953a9a48ee241587952ffe104_sourced extends Template
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

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return $this->parent ??= $this->load("partials/base.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("partials/base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<div class=\"hx-shell\">
    ";
        // line 5
        yield from $this->load("partials/sidebar.html.twig", 5)->unwrap()->yield($context);
        // line 6
        yield "
    <main class=\"hx-main\"  style=\"background:lightgrey   \" >
        <div class=\"hx-article-wrap\">
            <article class=\"hx-article\">
                <nav class=\"hx-breadcrumbs\" aria-label=\"breadcrumb\">
                    <a href=\"";
        // line 11
        yield (string) (((($context["base_url"] ?? null) == "")) ? ("/") : ($this->escaper->escape(($context["base_url"] ?? null), "html", null, true)));
        yield "\">Start</a>
                    ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::reverse($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "parents", [], "any", false, false, false, 12)));
        foreach ($context['_seq'] as $context["_key"] => $context["crumb"]) {
            // line 13
            yield "                        ";
            if (( !(($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["crumb"], "root", [], "any", false, false, false, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp) &&  !(($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["crumb"], "home", [], "any", false, false, false, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
                // line 14
                yield "                            <span>/</span><a href=\"";
                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["crumb"], "url", [], "any", false, false, false, 14), "html", null, true);
                yield "\">";
                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["crumb"], "menu", [], "any", false, false, false, 14), "html", null, true);
                yield "</a>
                        ";
            }
            // line 16
            yield "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['crumb'], $context['_parent']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 17
        yield "                    <span>/</span><span class=\"current\">";
        yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "menu", [], "any", false, false, false, 17), "html", null, true);
        yield "</span>
                </nav>

                <h1 class=\"hx-title\">";
        // line 20
        yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, false, 20), "html", null, true);
        yield "</h1>
                ";
        // line 21
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 21), "lead", [], "any", false, false, false, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<p class=\"hx-lead\">";
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 21), "lead", [], "any", false, false, false, 21), "html", null, true);
            yield "</p>";
        }
        // line 22
        yield "
                <div class=\"doc-content\" id=\"docContent\">
                    ";
        // line 24
        yield (string) CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, false, 24);
        yield "
                </div>

                ";
        // line 27
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "children", [], "any", false, false, false, 27), "visible", [], "any", false, false, false, 27), "count", [], "any", false, false, false, 27)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 28
            yield "                    <div class=\"row g-3 mt-3 hx-child-cards\">
                        ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "children", [], "any", false, false, false, 29), "visible", [], "any", false, false, false, 29));
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 30
                yield "                            <div class=\"col-sm-6\">
                                <a href=\"";
                // line 31
                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 31), "html", null, true);
                yield "\" class=\"hx-card d-block h-100\">
                                    <h3 class=\"mt-0\">";
                // line 32
                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "title", [], "any", false, false, false, 32), "html", null, true);
                yield "</h3>
                                    <p>";
                // line 33
                yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["child"], "header", [], "any", false, false, false, 33), "lead", [], "any", false, false, false, 33)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["child"], "header", [], "any", false, false, false, 33), "lead", [], "any", false, false, false, 33), "html", null, true)) : ($this->escaper->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "summary", [], "any", false, false, false, 33))), 0, 120), "html", null, true)));
                yield "</p>
                                </a>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['child'], $context['_parent']);
            $context = array_intersect_key($context, $_parent);
            $context += $_parent;
            // line 37
            yield "                    </div>
                ";
        }
        // line 39
        yield "
                ";
        // line 50
        yield "
                <div class=\"hx-meta d-flex flex-wrap justify-content-between gap-2\">
                    <span>Ostatnia aktualizacja: ";
        // line 52
        yield (string) $this->escaper->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "modified", [], "any", false, false, false, 52), "d.m.Y"), "html", null, true);
        yield "</span>
                    ";
        // line 53
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "theme", [], "any", false, false, false, 53), "github_edit_url", [], "any", false, false, false, 53)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 54
            yield "                        <a href=\"";
            yield (string) $this->escaper->escape(Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "theme", [], "any", false, false, false, 54), "github_edit_url", [], "any", false, false, false, 54), "/", "right"), "html", null, true);
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "relativePagePath", [], "any", false, false, false, 54), "html", null, true);
            yield "\" target=\"_blank\" rel=\"noopener\">Edytuj tę stronę na GitHubie ↗</a>
                    ";
        }
        // line 56
        yield "                </div>

                ";
        // line 58
        yield from $this->load("partials/footer.html.twig", 58)->unwrap()->yield($context);
        // line 59
        yield "            </article>

            <aside class=\"hx-toc d-none d-xl-block\">
                <div class=\"hx-toc-inner\">
                    <div class=\"hx-toc-title\">Na tej stronie</div>
                    <ul class=\"list-unstyled mb-0\" id=\"hxToc\"></ul>
                </div>
            </aside>
        </div>
    </main>
</div>
";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "chapter.html.twig";
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
        return array (  190 => 59,  188 => 58,  184 => 56,  177 => 54,  175 => 53,  171 => 52,  167 => 50,  164 => 39,  160 => 37,  149 => 33,  145 => 32,  141 => 31,  138 => 30,  134 => 29,  131 => 28,  129 => 27,  123 => 24,  119 => 22,  113 => 21,  109 => 20,  102 => 17,  95 => 16,  87 => 14,  84 => 13,  80 => 12,  76 => 11,  69 => 6,  67 => 5,  64 => 4,  57 => 3,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27partials/base.html.twig\x27 %}

{% block body %}
<div class=\"hx-shell\">
    {% include \x27partials/sidebar.html.twig\x27 %}

    <main class=\"hx-main\"  style=\"background:lightgrey   \" >
        <div class=\"hx-article-wrap\">
            <article class=\"hx-article\">
                <nav class=\"hx-breadcrumbs\" aria-label=\"breadcrumb\">
                    <a href=\"{{ base_url == \x27\x27 ? \x27/\x27 : base_url }}\">Start</a>
                    {% for crumb in page.parents|reverse %}
                        {% if not crumb.root and not crumb.home %}
                            <span>/</span><a href=\"{{ crumb.url }}\">{{ crumb.menu }}</a>
                        {% endif %}
                    {% endfor %}
                    <span>/</span><span class=\"current\">{{ page.menu }}</span>
                </nav>

                <h1 class=\"hx-title\">{{ page.title }}</h1>
                {% if page.header.lead %}<p class=\"hx-lead\">{{ page.header.lead }}</p>{% endif %}

                <div class=\"doc-content\" id=\"docContent\">
                    {{ page.content|raw }}
                </div>

                {% if page.children.visible.count %}
                    <div class=\"row g-3 mt-3 hx-child-cards\">
                        {% for child in page.children.visible %}
                            <div class=\"col-sm-6\">
                                <a href=\"{{ child.url }}\" class=\"hx-card d-block h-100\">
                                    <h3 class=\"mt-0\">{{ child.title }}</h3>
                                    <p>{{ child.header.lead ?: child.summary|striptags|trim|slice(0, 120) }}</p>
                                </a>
                            </div>
                        {% endfor %}
                    </div>
                {% endif %}

                {# <footer class=\"hx-pager\">
                    {% set prev = page.prevSibling %}
                    {% set next = page.nextSibling %}
                    {% if prev and prev.visible %}
                        <a class=\"hx-pager-link\" href=\"{{ prev.url }}\"><small>Poprzednia</small><span>← {{ prev.title }}</span></a>
                    {% else %}<span></span>{% endif %}
                    {% if next and next.visible %}
                        <a class=\"hx-pager-link text-end\" href=\"{{ next.url }}\"><small>Następna</small><span>{{ next.title }} →</span></a>
                    {% endif %}
                </footer> #}

                <div class=\"hx-meta d-flex flex-wrap justify-content-between gap-2\">
                    <span>Ostatnia aktualizacja: {{ page.modified|date(\x27d.m.Y\x27) }}</span>
                    {% if config.theme.github_edit_url %}
                        <a href=\"{{ config.theme.github_edit_url|trim(\x27/\x27, \x27right\x27) }}{{ page.relativePagePath }}\" target=\"_blank\" rel=\"noopener\">Edytuj tę stronę na GitHubie ↗</a>
                    {% endif %}
                </div>

                {% include \x27partials/footer.html.twig\x27 %}
            </article>

            <aside class=\"hx-toc d-none d-xl-block\">
                <div class=\"hx-toc-inner\">
                    <div class=\"hx-toc-title\">Na tej stronie</div>
                    <ul class=\"list-unstyled mb-0\" id=\"hxToc\"></ul>
                </div>
            </aside>
        </div>
    </main>
</div>
{% endblock %}
", "chapter.html.twig", "/var/www/html/user/themes/helios-bs/templates/chapter.html.twig");
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
