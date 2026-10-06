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

/* login.html.twig */
class __TwigTemplate_a23941e7a1ce8b4d01c08bb4782c45e2_sourced extends Template
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
        yield "    <div class=\"hx-shell\">
        ";
        // line 5
        yield from $this->load("partials/sidebar.html.twig", 5)->unwrap()->yield($context);
        // line 6
        yield "
        <main class=\"hx-main d-flex flex-column min-vh-100\">
            <div class=\"hx-login-wrapper flex-grow-1\">
                <div class=\"hx-login-card\">
                    <div class=\"text-center mb-4\">
                        <div class=\"hx-logo mx-auto mb-3\" style=\"width: 38px; height: 38px; border-radius: 10px;\"></div>
                        <h1 class=\"hx-login-title\">";
        // line 12
        yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, false, 12)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, false, 12), "html", null, true)) : ("Logowanie"));
        yield "</h1>
                        <p class=\"hx-login-subtitle\">Wprowadź dane dostępowe, aby przejść do zasobu</p>
                    </div>

                    <div class=\"hx-alerts\">
                        ";
        // line 17
        yield from $this->load("partials/messages.html.twig", 17)->unwrap()->yield($context);
        // line 18
        yield "                    </div>

                    ";
        // line 20
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 20), "authenticated", [], "any", false, false, false, 20)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 21
            yield "                        <div class=\"alert alert-info text-center mb-4\">
                            Zalogowano jako: <strong>";
            // line 22
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 22), "fullname", [], "any", false, false, false, 22)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 22), "fullname", [], "any", false, false, false, 22), "html", null, true)) : ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 22), "username", [], "any", false, false, false, 22), "html", null, true)));
            yield "</strong>
                        </div>

                        <a href=\"";
            // line 25
            yield (string) $this->escaper->escape(($context["base_url_absolute"] ?? null), "html", null, true);
            yield "\" class=\"btn hx-btn-primary w-100 mb-2 text-center d-block\">
                            Strona główna
                        </a>

                        <a
                            href=\"";
            // line 30
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["uri"] ?? null), "addNonce", [((((($context["base_url_relative"] ?? null) . CoreExtension::getAttribute($this->env, $this->source, ($context["uri"] ?? null), "path", [], "any", false, false, false, 30)) . "/task") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "system", [], "any", false, false, false, 30), "param_sep", [], "any", false, false, false, 30)) . "login.logout"), "logout-form", "logout-nonce"], "method", false, false, false, 30), "html", null, true);
            yield "\"
                            class=\"btn hx-btn-ghost w-100 text-center d-block\"
                        >
                            Wyloguj się
                        </a>
                    ";
        } else {
            // line 36
            yield "                        ";
            // line 37
            yield "                        ";
            yield from $this->load("partials/login-form.html.twig", 37)->unwrap()->yield($context);
            // line 38
            yield "                    ";
        }
        // line 39
        yield "                </div>
            </div>

            <div class=\"container\" style=\"max-width:1050px\">
                ";
        // line 43
        yield from $this->load("partials/footer.html.twig", 43)->unwrap()->yield($context);
        // line 44
        yield "            </div>
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
        return "login.html.twig";
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
        return array (  135 => 44,  133 => 43,  127 => 39,  124 => 38,  121 => 37,  119 => 36,  110 => 30,  102 => 25,  96 => 22,  93 => 21,  91 => 20,  87 => 18,  85 => 17,  77 => 12,  69 => 6,  67 => 5,  64 => 4,  57 => 3,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27partials/base.html.twig\x27 %}

{% block body %}
    <div class=\"hx-shell\">
        {% include \x27partials/sidebar.html.twig\x27 %}

        <main class=\"hx-main d-flex flex-column min-vh-100\">
            <div class=\"hx-login-wrapper flex-grow-1\">
                <div class=\"hx-login-card\">
                    <div class=\"text-center mb-4\">
                        <div class=\"hx-logo mx-auto mb-3\" style=\"width: 38px; height: 38px; border-radius: 10px;\"></div>
                        <h1 class=\"hx-login-title\">{{ page.title ?: \x27Logowanie\x27 }}</h1>
                        <p class=\"hx-login-subtitle\">Wprowadź dane dostępowe, aby przejść do zasobu</p>
                    </div>

                    <div class=\"hx-alerts\">
                        {% include \x27partials/messages.html.twig\x27 %}
                    </div>

                    {% if grav.user.authenticated %}
                        <div class=\"alert alert-info text-center mb-4\">
                            Zalogowano jako: <strong>{{ grav.user.fullname ?: grav.user.username }}</strong>
                        </div>

                        <a href=\"{{ base_url_absolute }}\" class=\"btn hx-btn-primary w-100 mb-2 text-center d-block\">
                            Strona główna
                        </a>

                        <a
                            href=\"{{ uri.addNonce(base_url_relative ~ uri.path ~ \x27/task\x27 ~ config.system.param_sep ~ \x27login.logout\x27, \x27logout-form\x27, \x27logout-nonce\x27) }}\"
                            class=\"btn hx-btn-ghost w-100 text-center d-block\"
                        >
                            Wyloguj się
                        </a>
                    {% else %}
                        {# Osadzenie oryginalnego formularza Grava z obsługą tokenów i sesji #}
                        {% include \x27partials/login-form.html.twig\x27 %}
                    {% endif %}
                </div>
            </div>

            <div class=\"container\" style=\"max-width:1050px\">
                {% include \x27partials/footer.html.twig\x27 %}
            </div>
        </main>
    </div>
{% endblock %}", "login.html.twig", "/var/www/html/user/themes/helios-bs/templates/login.html.twig");
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
