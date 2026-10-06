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

/* partials/messages.html.twig */
class __TwigTemplate_954da9220af426d09ca7d85420847cb5_sourced extends Template
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
        $context["messages"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "messages", [], "any", false, false, false, 1), "fetch", [], "any", false, false, false, 1);
        // line 2
        if ((($tmp = Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["messages"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 3
            yield "    <div class=\"hx-messages mb-3\">
        ";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["messages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 5
                yield "            ";
                $context["msg_type"] = (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["message"], "scope", [], "any", false, false, false, 5)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, $context["message"], "scope", [], "any", false, false, false, 5)) : ("info"));
                // line 6
                yield "            ";
                if ((($context["msg_type"] ?? null) == "error")) {
                    // line 7
                    yield "                ";
                    $context["alert_class"] = "alert-danger";
                    // line 8
                    yield "            ";
                } elseif ((($context["msg_type"] ?? null) == "warning")) {
                    // line 9
                    yield "                ";
                    $context["alert_class"] = "alert-warning";
                    // line 10
                    yield "            ";
                } elseif ((($context["msg_type"] ?? null) == "success")) {
                    // line 11
                    yield "                ";
                    $context["alert_class"] = "alert-success";
                    // line 12
                    yield "            ";
                } else {
                    // line 13
                    yield "                ";
                    $context["alert_class"] = "alert-info";
                    // line 14
                    yield "            ";
                }
                // line 15
                yield "
            <div class=\"alert ";
                // line 16
                yield (string) $this->escaper->escape(($context["alert_class"] ?? null), "html", null, true);
                yield " py-2 px-3 mb-2\" role=\"alert\" style=\"font-size: 0.88rem; border-radius: 8px;\">
                ";
                // line 17
                yield (string) CoreExtension::getAttribute($this->env, $this->source, $context["message"], "message", [], "any", false, false, false, 17);
                yield "
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent);
            $context += $_parent;
            // line 20
            yield "    </div>
";
        }
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/messages.html.twig";
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
        return array (  106 => 20,  96 => 17,  92 => 16,  89 => 15,  86 => 14,  83 => 13,  80 => 12,  77 => 11,  74 => 10,  71 => 9,  68 => 8,  65 => 7,  62 => 6,  59 => 5,  55 => 4,  52 => 3,  50 => 2,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% set messages = grav.messages.fetch %}
{% if messages|length %}
    <div class=\"hx-messages mb-3\">
        {% for message in messages %}
            {% set msg_type = message.scope ?: \x27info\x27 %}
            {% if msg_type == \x27error\x27 %}
                {% set alert_class = \x27alert-danger\x27 %}
            {% elseif msg_type == \x27warning\x27 %}
                {% set alert_class = \x27alert-warning\x27 %}
            {% elseif msg_type == \x27success\x27 %}
                {% set alert_class = \x27alert-success\x27 %}
            {% else %}
                {% set alert_class = \x27alert-info\x27 %}
            {% endif %}

            <div class=\"alert {{ alert_class }} py-2 px-3 mb-2\" role=\"alert\" style=\"font-size: 0.88rem; border-radius: 8px;\">
                {{ message.message|raw }}
            </div>
        {% endfor %}
    </div>
{% endif %}", "partials/messages.html.twig", "/var/www/html/user/themes/helios-bs/templates/partials/messages.html.twig");
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
