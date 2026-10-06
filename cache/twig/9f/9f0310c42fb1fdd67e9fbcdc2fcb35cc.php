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

/* home.html.twig */
class __TwigTemplate_afa7ad735b1c7098c5393725d8d86b59_sourced extends Template
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
    <main class=\"hx-main\">
        <section class=\"hx-hero text-center\">
            <div class=\"hx-hero-glow\"></div>
            <div class=\"container position-relative\">
                ";
        // line 11
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 11), "badge", [], "any", false, false, false, 11)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<span class=\"hx-badge\">";
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 11), "badge", [], "any", false, false, false, 11), "html", null, true);
            yield "</span>";
        }
        // line 12
        yield "                <h1 class=\"hx-hero-title\">";
        yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 12), "hero_title", [], "any", false, false, false, 12)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 12), "hero_title", [], "any", false, false, false, 12), "html", null, true)) : ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, false, 12), "html", null, true)));
        yield "</h1>
                ";
        // line 13
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 13), "hero_subtitle", [], "any", false, false, false, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<p class=\"hx-hero-sub\">";
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 13), "hero_subtitle", [], "any", false, false, false, 13), "html", null, true);
            yield "</p>";
        }
        // line 14
        yield "                <div class=\"d-flex justify-content-center gap-2 flex-wrap mt-4\">
                    ";
        // line 15
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 15), "hero_button_text", [], "any", false, false, false, 15)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 16
            yield "                        <a href=\"";
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 16), "hero_button_link", [], "any", false, false, false, 16)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 16), "hero_button_link", [], "any", false, false, false, 16), "html", null, true)) : ("#"));
            yield "\" class=\"btn hx-btn-primary\">";
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 16), "hero_button_text", [], "any", false, false, false, 16), "html", null, true);
            yield "</a>
                    ";
        }
        // line 18
        yield "                    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 18), "hero_button2_text", [], "any", false, false, false, 18)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 19
            yield "                        <a href=\"";
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 19), "hero_button2_link", [], "any", false, false, false, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 19), "hero_button2_link", [], "any", false, false, false, 19), "html", null, true)) : ("#"));
            yield "\" class=\"btn hx-btn-ghost\">";
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, false, 19), "hero_button2_text", [], "any", false, false, false, 19), "html", null, true);
            yield "</a>
                    ";
        }
        // line 21
        yield "                </div>
            </div>
        </section>

        <section class=\"container hx-home-body\">
            <div class=\"doc-content\">";
        // line 26
        yield (string) CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, false, 26);
        yield "</div>

            <div class=\"row g-3 mt-2\">
                ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["pages"] ?? null), "children", [], "any", false, false, false, 29), "visible", [], "any", false, false, false, 29));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 30
            yield "                    ";
            if ( !(($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "home", [], "any", false, false, false, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 31
                yield "                        ";
                $context["count"] = Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "children", [], "any", false, false, false, 31), "visible", [], "any", false, false, false, 31));
                // line 32
                yield "                        <div class=\"col-md-6 col-xl-4\">
                            <a href=\"";
                // line 33
                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "url", [], "any", false, false, false, 33), "html", null, true);
                yield "\" class=\"hx-card d-block h-100 position-relative\">
                                <div class=\"d-flex justify-content-between align-items-start mb-2\">
                                    <div class=\"hx-card-icon\">";
                // line 35
                yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "header", [], "any", false, false, false, 35), "icon", [], "any", false, false, false, 35)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "header", [], "any", false, false, false, 35), "icon", [], "any", false, false, false, 35), "html", null, true)) : ("▣"));
                yield "</div>
                                    <span class=\"badge bg-light text-dark border\">
                                        ";
                // line 37
                yield (string) $this->escaper->escape(($context["count"] ?? null), "html", null, true);
                yield "
                                        ";
                // line 38
                if ((($context["count"] ?? null) == 1)) {
                    // line 39
                    yield "                                            wpis
                                        ";
                } elseif ((CoreExtension::inFilter((                // line 40
($context["count"] ?? null) % 10), [2, 3, 4]) && !CoreExtension::inFilter((($context["count"] ?? null) % 100), [12, 13, 14]))) {
                    // line 41
                    yield "                                            wpisy
                                        ";
                } else {
                    // line 43
                    yield "                                            wpisów
                                        ";
                }
                // line 45
                yield "                                    </span>
                                </div>
                                <h3>";
                // line 47
                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "menu", [], "any", false, false, false, 47), "html", null, true);
                yield "</h3>
                                <p>";
                // line 48
                yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "header", [], "any", false, false, false, 48), "lead", [], "any", false, false, false, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "header", [], "any", false, false, false, 48), "lead", [], "any", false, false, false, 48), "html", null, true)) : ($this->escaper->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "summary", [], "any", false, false, false, 48)), 0, 110), "html", null, true)));
                yield "</p>
                            </a>
                        </div>
                    ";
            }
            // line 52
            yield "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['section'], $context['_parent']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 53
        yield "            </div>
        </section>

        <div class=\"container\" style=\"max-width:1050px\">
            ";
        // line 57
        yield from $this->load("partials/footer.html.twig", 57)->unwrap()->yield($context);
        // line 58
        yield "        </div>
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
        return "home.html.twig";
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
        return array (  202 => 58,  200 => 57,  194 => 53,  187 => 52,  180 => 48,  176 => 47,  172 => 45,  168 => 43,  164 => 41,  162 => 40,  159 => 39,  157 => 38,  153 => 37,  148 => 35,  143 => 33,  140 => 32,  137 => 31,  134 => 30,  130 => 29,  124 => 26,  117 => 21,  109 => 19,  106 => 18,  98 => 16,  96 => 15,  93 => 14,  87 => 13,  82 => 12,  76 => 11,  69 => 6,  67 => 5,  64 => 4,  57 => 3,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27partials/base.html.twig\x27 %}

{% block body %}
<div class=\"hx-shell\">
    {% include \x27partials/sidebar.html.twig\x27 %}

    <main class=\"hx-main\">
        <section class=\"hx-hero text-center\">
            <div class=\"hx-hero-glow\"></div>
            <div class=\"container position-relative\">
                {% if page.header.badge %}<span class=\"hx-badge\">{{ page.header.badge }}</span>{% endif %}
                <h1 class=\"hx-hero-title\">{{ page.header.hero_title ?: page.title }}</h1>
                {% if page.header.hero_subtitle %}<p class=\"hx-hero-sub\">{{ page.header.hero_subtitle }}</p>{% endif %}
                <div class=\"d-flex justify-content-center gap-2 flex-wrap mt-4\">
                    {% if page.header.hero_button_text %}
                        <a href=\"{{ page.header.hero_button_link ?: \x27#\x27 }}\" class=\"btn hx-btn-primary\">{{ page.header.hero_button_text }}</a>
                    {% endif %}
                    {% if page.header.hero_button2_text %}
                        <a href=\"{{ page.header.hero_button2_link ?: \x27#\x27 }}\" class=\"btn hx-btn-ghost\">{{ page.header.hero_button2_text }}</a>
                    {% endif %}
                </div>
            </div>
        </section>

        <section class=\"container hx-home-body\">
            <div class=\"doc-content\">{{ page.content|raw }}</div>

            <div class=\"row g-3 mt-2\">
                {% for section in pages.children.visible %}
                    {% if not section.home %}
                        {% set count = section.children.visible|length %}
                        <div class=\"col-md-6 col-xl-4\">
                            <a href=\"{{ section.url }}\" class=\"hx-card d-block h-100 position-relative\">
                                <div class=\"d-flex justify-content-between align-items-start mb-2\">
                                    <div class=\"hx-card-icon\">{{ section.header.icon ?: \x27▣\x27 }}</div>
                                    <span class=\"badge bg-light text-dark border\">
                                        {{ count }}
                                        {% if count == 1 %}
                                            wpis
                                        {% elseif count % 10 in [2, 3, 4] and count % 100 not in [12, 13, 14] %}
                                            wpisy
                                        {% else %}
                                            wpisów
                                        {% endif %}
                                    </span>
                                </div>
                                <h3>{{ section.menu }}</h3>
                                <p>{{ section.header.lead ?: section.summary|striptags|slice(0, 110) }}</p>
                            </a>
                        </div>
                    {% endif %}
                {% endfor %}
            </div>
        </section>

        <div class=\"container\" style=\"max-width:1050px\">
            {% include \x27partials/footer.html.twig\x27 %}
        </div>
    </main>
</div>
{% endblock %}", "home.html.twig", "/var/www/html/user/themes/helios-bs/templates/home.html.twig");
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
