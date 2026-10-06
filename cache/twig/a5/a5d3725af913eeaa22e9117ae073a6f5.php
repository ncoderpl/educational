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

/* partials/login-form.html.twig */
class __TwigTemplate_cc9aa9b7037a2a5b9ae4e1f94039d033_sourced extends Template
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
        $context["form"] = (((array_key_exists("form", $context) &&  !(null === $context["form"]))) ? ($context["form"]) : (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "login", [], "any", false, false, false, 1), "form", [], "any", false, false, false, 1)));
        // line 2
        yield "
<form method=\"post\" action=\"";
        // line 3
        yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["uri"] ?? null), "route", [true], "method", false, false, false, 3), "html", null, true);
        yield "\" class=\"hx-login-form\">
    ";
        // line 5
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "fields", [], "any", false, false, false, 5));
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
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 6
            yield "        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["field"], "type", [], "any", false, false, false, 6)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 7
                yield "            ";
                $context["value"] = CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "value", [CoreExtension::getAttribute($this->env, $this->source, $context["field"], "name", [], "any", false, false, false, 7)], "method", false, false, false, 7);
                // line 8
                yield "            <div class=\"form-field form-field-";
                yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "type", [], "any", false, false, false, 8), "html", null, true);
                yield " mb-3\">
                ";
                // line 9
                try {
                    $_v0 = $this->load([(((("forms/fields/" . CoreExtension::getAttribute($this->env, $this->source, $context["field"], "type", [], "any", false, false, false, 9)) . "/") . CoreExtension::getAttribute($this->env, $this->source, $context["field"], "type", [], "any", false, false, false, 9)) . ".html.twig"), "forms/fields/text/text.html.twig"], 9);
                } catch (LoaderError $e) {
                    // ignore missing template
                    $_v0 = null;
                }
                if ($_v0) {
                    yield from $_v0->unwrap()->yield($context);
                }
                // line 10
                yield "            </div>
        ";
            }
            // line 12
            yield "    ";
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
        unset($context['_seq'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 13
        yield "
    ";
        // line 15
        yield "    ";
        yield (string) CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "renderHiddenFields", [], "method", false, false, false, 15);
        yield "
    ";
        // line 16
        yield (string) $this->extensions['Grav\Common\Twig\Extension\GravExtension']->nonceFieldFunc("login-form", "login-form-nonce");
        yield "

    <div class=\"form-actions mt-3\">
        <button type=\"submit\" name=\"task\" value=\"login.login\" class=\"btn hx-btn-primary w-100 py-2\">
            Zaloguj się
        </button>
    </div>
</form>";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/login-form.html.twig";
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
        return array (  123 => 16,  118 => 15,  115 => 13,  100 => 12,  96 => 10,  86 => 9,  81 => 8,  78 => 7,  75 => 6,  57 => 5,  53 => 3,  50 => 2,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% set form = form ?? grav.login.form %}

<form method=\"post\" action=\"{{ uri.route(true) }}\" class=\"hx-login-form\">
    {# Renderowanie pól formularza wygenerowanych przez wtyczkę Login #}
    {% for field in form.fields %}
        {% if field.type %}
            {% set value = form.value(field.name) %}
            <div class=\"form-field form-field-{{ field.type }} mb-3\">
                {% include [\"forms/fields/#{field.type}/#{field.type}.html.twig\", \x27forms/fields/text/text.html.twig\x27] ignore missing %}
            </div>
        {% endif %}
    {% endfor %}

    {# Bezpieczne tokeny i ukryte pola wymagane przez Form/Login #}
    {{ form.renderHiddenFields()|raw }}
    {{ nonce_field(\x27login-form\x27, \x27login-form-nonce\x27)|raw }}

    <div class=\"form-actions mt-3\">
        <button type=\"submit\" name=\"task\" value=\"login.login\" class=\"btn hx-btn-primary w-100 py-2\">
            Zaloguj się
        </button>
    </div>
</form>", "partials/login-form.html.twig", "/var/www/html/user/themes/helios-bs/templates/partials/login-form.html.twig");
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
