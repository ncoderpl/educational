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

/* partials/sidebar.html.twig */
class __TwigTemplate_a537ae911319e50e233e9a2c5c88da8c_sourced extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<div class=\"offcanvas-lg offcanvas-start hx-sidebar\" tabindex=\"-1\" id=\"hxSidebar\" aria-label=\"Nawigacja\">
    <div class=\"offcanvas-header d-lg-none\">
        <span class=\"hx-brand\"><span class=\"hx-logo\"></span>";
        // line 3
        yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["site"] ?? null), "title", [], "any", false, false, false, 3), "html", null, true);
        yield "</span>
        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"offcanvas\" data-bs-target=\"#hxSidebar\" aria-label=\"Zamknij\"></button>
    </div>
    <div class=\"offcanvas-body flex-column\">
        <nav class=\"hx-nav\" id=\"hxNav\">
            ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["pages"] ?? null), "children", [], "any", false, false, false, 8), "visible", [], "any", false, false, false, 8));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 9
            yield "                ";
            if ( !(($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "home", [], "any", false, false, false, 9)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 10
                yield "                    ";
                $context["is_branch_active"] = ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "active", [], "any", false, false, false, 10)) && $tmp instanceof Markup ? (string) $tmp : $tmp) || (($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "activeChild", [], "any", false, false, false, 10)) && $tmp instanceof Markup ? (string) $tmp : $tmp));
                // line 11
                yield "
                    ";
                // line 12
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "children", [], "any", false, false, false, 12), "visible", [], "any", false, false, false, 12), "count", [], "any", false, false, false, 12)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 13
                    yield "                        <details class=\"hx-group ";
                    yield (string) (((($tmp = ($context["is_branch_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-active-branch") : (""));
                    yield "\" ";
                    yield (string) (((($tmp = ($context["is_branch_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("open") : (""));
                    yield ">
                            <summary class=\"hx-group-title\">
                                <span>";
                    // line 15
                    yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "menu", [], "any", false, false, false, 15), "html", null, true);
                    yield "</span>
                                <svg class=\"hx-chev\" width=\"14\" height=\"14\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M9 6l6 6-6 6\"/></svg>
                            </summary>
                            <ul class=\"list-unstyled mb-0 hx-group-list\">
                                <li><a class=\"hx-nav-link ";
                    // line 19
                    yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "active", [], "any", false, false, false, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                    yield "\" href=\"";
                    yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "url", [], "any", false, false, false, 19), "html", null, true);
                    yield "\"> Lista wpisów </a></li>
                                ";
                    // line 20
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "children", [], "any", false, false, false, 20), "visible", [], "any", false, false, false, 20));
                    foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                        // line 21
                        yield "                                    ";
                        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["child"], "children", [], "any", false, false, false, 21), "visible", [], "any", false, false, false, 21), "count", [], "any", false, false, false, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                            // line 22
                            yield "                                        <li>
                                            <details class=\"hx-subgroup\" ";
                            // line 23
                            yield (string) ((((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "active", [], "any", false, false, false, 23)) && $tmp instanceof Markup ? (string) $tmp : $tmp) || (($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "activeChild", [], "any", false, false, false, 23)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) ? ("open") : (""));
                            yield ">
                                                <summary class=\"hx-nav-link hx-sub-summary ";
                            // line 24
                            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "active", [], "any", false, false, false, 24)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                            yield "\">
                                                    <span>";
                            // line 25
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "menu", [], "any", false, false, false, 25), "html", null, true);
                            yield "</span>
                                                    <svg class=\"hx-chev\" width=\"12\" height=\"12\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M9 6l6 6-6 6\"/></svg>
                                                </summary>
                                                <ul class=\"list-unstyled hx-nav-sub\">
                                                    <li><a class=\"hx-nav-link ";
                            // line 29
                            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "active", [], "any", false, false, false, 29)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                            yield "\" href=\"";
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 29), "html", null, true);
                            yield "\"> Lista wpisów </a></li>
                                                    ";
                            // line 30
                            $context['_parent'] = $context;
                            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["child"], "children", [], "any", false, false, false, 30), "visible", [], "any", false, false, false, 30));
                            foreach ($context['_seq'] as $context["_key"] => $context["sub"]) {
                                // line 31
                                yield "                                                        <li><a class=\"hx-nav-link ";
                                yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["sub"], "active", [], "any", false, false, false, 31)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                                yield "\" href=\"";
                                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sub"], "url", [], "any", false, false, false, 31), "html", null, true);
                                yield "\">";
                                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sub"], "menu", [], "any", false, false, false, 31), "html", null, true);
                                yield "</a></li>
                                                    ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_key'], $context['sub'], $context['_parent']);
                            $context = array_intersect_key($context, $_parent);
                            $context += $_parent;
                            // line 33
                            yield "                                                </ul>
                                            </details>
                                        </li>
                                    ";
                        } else {
                            // line 37
                            yield "                                        <li><a class=\"hx-nav-link ";
                            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "active", [], "any", false, false, false, 37)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                            yield "\" href=\"";
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 37), "html", null, true);
                            yield "\">";
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "menu", [], "any", false, false, false, 37), "html", null, true);
                            yield "</a></li>
                                    ";
                        }
                        // line 39
                        yield "                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['child'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent);
                    $context += $_parent;
                    // line 40
                    yield "                            </ul>
                        </details>
                    ";
                } else {
                    // line 43
                    yield "                        ";
                    // line 44
                    yield "                        <div class=\"hx-group ";
                    yield (string) (((($tmp = ($context["is_branch_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-active-branch") : (""));
                    yield "\">
                            <a class=\"hx-nav-link ";
                    // line 45
                    yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "active", [], "any", false, false, false, 45)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                    yield "\" href=\"";
                    yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "url", [], "any", false, false, false, 45), "html", null, true);
                    yield "\">";
                    yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "menu", [], "any", false, false, false, 45), "html", null, true);
                    yield "</a>
                        </div>
                    ";
                }
                // line 48
                yield "                ";
            }
            // line 49
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['section'], $context['_parent']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 50
        yield "        </nav>
    </div>
</div>";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/sidebar.html.twig";
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
        return array (  200 => 50,  193 => 49,  190 => 48,  180 => 45,  175 => 44,  173 => 43,  168 => 40,  161 => 39,  151 => 37,  145 => 33,  131 => 31,  127 => 30,  121 => 29,  114 => 25,  110 => 24,  106 => 23,  103 => 22,  100 => 21,  96 => 20,  90 => 19,  83 => 15,  75 => 13,  73 => 12,  70 => 11,  67 => 10,  64 => 9,  60 => 8,  52 => 3,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"offcanvas-lg offcanvas-start hx-sidebar\" tabindex=\"-1\" id=\"hxSidebar\" aria-label=\"Nawigacja\">
    <div class=\"offcanvas-header d-lg-none\">
        <span class=\"hx-brand\"><span class=\"hx-logo\"></span>{{ site.title }}</span>
        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"offcanvas\" data-bs-target=\"#hxSidebar\" aria-label=\"Zamknij\"></button>
    </div>
    <div class=\"offcanvas-body flex-column\">
        <nav class=\"hx-nav\" id=\"hxNav\">
            {% for section in pages.children.visible %}
                {% if not section.home %}
                    {% set is_branch_active = section.active or section.activeChild %}

                    {% if section.children.visible.count %}
                        <details class=\"hx-group {{ is_branch_active ? \x27is-active-branch\x27 : \x27\x27 }}\" {{ is_branch_active ? \x27open\x27 : \x27\x27 }}>
                            <summary class=\"hx-group-title\">
                                <span>{{ section.menu }}</span>
                                <svg class=\"hx-chev\" width=\"14\" height=\"14\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M9 6l6 6-6 6\"/></svg>
                            </summary>
                            <ul class=\"list-unstyled mb-0 hx-group-list\">
                                <li><a class=\"hx-nav-link {{ section.active ? \x27active\x27 : \x27\x27 }}\" href=\"{{ section.url }}\"> Lista wpisów </a></li>
                                {% for child in section.children.visible %}
                                    {% if child.children.visible.count %}
                                        <li>
                                            <details class=\"hx-subgroup\" {{ child.active or child.activeChild ? \x27open\x27 : \x27\x27 }}>
                                                <summary class=\"hx-nav-link hx-sub-summary {{ child.active ? \x27active\x27 : \x27\x27 }}\">
                                                    <span>{{ child.menu }}</span>
                                                    <svg class=\"hx-chev\" width=\"12\" height=\"12\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M9 6l6 6-6 6\"/></svg>
                                                </summary>
                                                <ul class=\"list-unstyled hx-nav-sub\">
                                                    <li><a class=\"hx-nav-link {{ child.active ? \x27active\x27 : \x27\x27 }}\" href=\"{{ child.url }}\"> Lista wpisów </a></li>
                                                    {% for sub in child.children.visible %}
                                                        <li><a class=\"hx-nav-link {{ sub.active ? \x27active\x27 : \x27\x27 }}\" href=\"{{ sub.url }}\">{{ sub.menu }}</a></li>
                                                    {% endfor %}
                                                </ul>
                                            </details>
                                        </li>
                                    {% else %}
                                        <li><a class=\"hx-nav-link {{ child.active ? \x27active\x27 : \x27\x27 }}\" href=\"{{ child.url }}\">{{ child.menu }}</a></li>
                                    {% endif %}
                                {% endfor %}
                            </ul>
                        </details>
                    {% else %}
                        {# Pojedynczy kurs/sekcja bez podstron #}
                        <div class=\"hx-group {{ is_branch_active ? \x27is-active-branch\x27 : \x27\x27 }}\">
                            <a class=\"hx-nav-link {{ section.active ? \x27active\x27 : \x27\x27 }}\" href=\"{{ section.url }}\">{{ section.menu }}</a>
                        </div>
                    {% endif %}
                {% endif %}
            {% endfor %}
        </nav>
    </div>
</div>", "partials/sidebar.html.twig", "/var/www/html/user/themes/helios-bs/templates/partials/sidebar.html.twig");
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
