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
                                ";
                    // line 20
                    yield "                                <li><a class=\"hx-nav-link ";
                    yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "active", [], "any", false, false, false, 20)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                    yield "\" href=\"";
                    yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "url", [], "any", false, false, false, 20), "html", null, true);
                    yield "\"> Lista wpisów </a></li>

                                ";
                    // line 23
                    yield "                                ";
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "children", [], "any", false, false, false, 23), "visible", [], "any", false, false, false, 23));
                    $context['loop'] = [
                      'parent' => $context['_parent'],
                      'index0' => 0,
                      'index'  => 1,
                      'first'  => true,
                    ];
                    if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                        $length = count($context['_seq']);
                        $context['loop']['revindex0'] = $length - 1;
                        $context['loop']['revindex'] = $length;
                        $context['loop']['length'] = $length;
                        $context['loop']['last'] = 1 === $length;
                    }
                    foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                        // line 24
                        yield "                                    ";
                        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["child"], "children", [], "any", false, false, false, 24), "visible", [], "any", false, false, false, 24), "count", [], "any", false, false, false, 24)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                            // line 25
                            yield "                                        <li>
                                            <details class=\"hx-subgroup\" ";
                            // line 26
                            yield (string) ((((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "active", [], "any", false, false, false, 26)) && $tmp instanceof Markup ? (string) $tmp : $tmp) || (($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "activeChild", [], "any", false, false, false, 26)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) ? ("open") : (""));
                            yield ">
                                                <summary class=\"hx-nav-link hx-sub-summary ";
                            // line 27
                            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "active", [], "any", false, false, false, 27)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                            yield "\">
                                                    <span><span class=\"opacity-50 me-1\">";
                            // line 28
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 28), "html", null, true);
                            yield ".</span>";
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "menu", [], "any", false, false, false, 28), "html", null, true);
                            yield "</span>
                                                    <svg class=\"hx-chev\" width=\"12\" height=\"12\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M9 6l6 6-6 6\"/></svg>
                                                </summary>
                                                <ul class=\"list-unstyled hx-nav-sub\">
                                                    ";
                            // line 33
                            yield "                                                    <li><a class=\"hx-nav-link ";
                            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "active", [], "any", false, false, false, 33)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                            yield "\" href=\"";
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 33), "html", null, true);
                            yield "\"> Lista wpisów </a></li>

                                                    ";
                            // line 36
                            yield "                                                    ";
                            $context['_parent'] = $context;
                            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["child"], "children", [], "any", false, false, false, 36), "visible", [], "any", false, false, false, 36));
                            $context['loop'] = [
                              'parent' => $context['_parent'],
                              'index0' => 0,
                              'index'  => 1,
                              'first'  => true,
                            ];
                            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                                $length = count($context['_seq']);
                                $context['loop']['revindex0'] = $length - 1;
                                $context['loop']['revindex'] = $length;
                                $context['loop']['length'] = $length;
                                $context['loop']['last'] = 1 === $length;
                            }
                            foreach ($context['_seq'] as $context["_key"] => $context["sub"]) {
                                // line 37
                                yield "                                                        <li><a class=\"hx-nav-link ";
                                yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["sub"], "active", [], "any", false, false, false, 37)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                                yield "\" href=\"";
                                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sub"], "url", [], "any", false, false, false, 37), "html", null, true);
                                yield "\"><span class=\"opacity-50 me-1\">";
                                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 37), "html", null, true);
                                yield ".</span>";
                                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sub"], "menu", [], "any", false, false, false, 37), "html", null, true);
                                yield "</a></li>
                                                    ";
                                ++$context['loop']['index0'];
                                ++$context['loop']['index'];
                                $context['loop']['first'] = false;
                                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                                    --$context['loop']['revindex0'];
                                    --$context['loop']['revindex'];
                                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                                }
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_key'], $context['sub'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent);
                            $context += $_parent;
                            // line 39
                            yield "                                                </ul>
                                            </details>
                                        </li>
                                    ";
                        } else {
                            // line 43
                            yield "                                        <li><a class=\"hx-nav-link ";
                            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["child"], "active", [], "any", false, false, false, 43)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                            yield "\" href=\"";
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 43), "html", null, true);
                            yield "\"><span class=\"opacity-50 me-1\">";
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 43), "html", null, true);
                            yield ".</span>";
                            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["child"], "menu", [], "any", false, false, false, 43), "html", null, true);
                            yield "</a></li>
                                    ";
                        }
                        // line 45
                        yield "                                ";
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                        if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                            --$context['loop']['revindex0'];
                            --$context['loop']['revindex'];
                            $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent);
                    $context += $_parent;
                    // line 46
                    yield "                            </ul>
                        </details>
                    ";
                } else {
                    // line 49
                    yield "                        ";
                    // line 50
                    yield "                        <div class=\"hx-group ";
                    yield (string) (((($tmp = ($context["is_branch_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-active-branch") : (""));
                    yield "\">
                            <a class=\"hx-nav-link ";
                    // line 51
                    yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "active", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
                    yield "\" href=\"";
                    yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "url", [], "any", false, false, false, 51), "html", null, true);
                    yield "\">";
                    yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "menu", [], "any", false, false, false, 51), "html", null, true);
                    yield "</a>
                        </div>
                    ";
                }
                // line 54
                yield "                ";
            }
            // line 55
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['section'], $context['_parent']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 56
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
        return array (  254 => 56,  247 => 55,  244 => 54,  234 => 51,  229 => 50,  227 => 49,  222 => 46,  207 => 45,  195 => 43,  189 => 39,  165 => 37,  147 => 36,  139 => 33,  130 => 28,  126 => 27,  122 => 26,  119 => 25,  116 => 24,  98 => 23,  90 => 20,  83 => 15,  75 => 13,  73 => 12,  70 => 11,  67 => 10,  64 => 9,  60 => 8,  52 => 3,  48 => 1,);
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
                                {# Index rozdziału (chapter) - bez numeracji #}
                                <li><a class=\"hx-nav-link {{ section.active ? \x27active\x27 : \x27\x27 }}\" href=\"{{ section.url }}\"> Lista wpisów </a></li>

                                {# Właściwe lekcje - z numeracją #}
                                {% for child in section.children.visible %}
                                    {% if child.children.visible.count %}
                                        <li>
                                            <details class=\"hx-subgroup\" {{ child.active or child.activeChild ? \x27open\x27 : \x27\x27 }}>
                                                <summary class=\"hx-nav-link hx-sub-summary {{ child.active ? \x27active\x27 : \x27\x27 }}\">
                                                    <span><span class=\"opacity-50 me-1\">{{ loop.index }}.</span>{{ child.menu }}</span>
                                                    <svg class=\"hx-chev\" width=\"12\" height=\"12\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M9 6l6 6-6 6\"/></svg>
                                                </summary>
                                                <ul class=\"list-unstyled hx-nav-sub\">
                                                    {# Index podrozdziału - bez numeracji #}
                                                    <li><a class=\"hx-nav-link {{ child.active ? \x27active\x27 : \x27\x27 }}\" href=\"{{ child.url }}\"> Lista wpisów </a></li>

                                                    {# Właściwe pod-lekcje - z numeracją #}
                                                    {% for sub in child.children.visible %}
                                                        <li><a class=\"hx-nav-link {{ sub.active ? \x27active\x27 : \x27\x27 }}\" href=\"{{ sub.url }}\"><span class=\"opacity-50 me-1\">{{ loop.index }}.</span>{{ sub.menu }}</a></li>
                                                    {% endfor %}
                                                </ul>
                                            </details>
                                        </li>
                                    {% else %}
                                        <li><a class=\"hx-nav-link {{ child.active ? \x27active\x27 : \x27\x27 }}\" href=\"{{ child.url }}\"><span class=\"opacity-50 me-1\">{{ loop.index }}.</span>{{ child.menu }}</a></li>
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
