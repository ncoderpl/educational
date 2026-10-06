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

/* unauthorized.html.twig */
class __TwigTemplate_de4c9e2521d1693241eddea7d2ff14d9_sourced extends Template
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
                <div class=\"hx-login-card text-center\">
                    <div class=\"hx-card-icon mx-auto mb-3\" style=\"width: 48px; height: 48px; line-height: 48px; font-size: 1.4rem; color: #ef5b5b; background: rgba(239, 91, 91, 0.12);\">
                        ✕
                    </div>

                    <h1 class=\"hx-login-title\">Brak dostępu</h1>
                    <p class=\"hx-login-subtitle mb-4\">
                        Nie posiadasz uprawnień wymaganych do przeglądania tych materiałów.
                    </p>

                    ";
        // line 19
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 19), "authenticated", [], "any", false, false, false, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 20
            yield "                        <div class=\"alert alert-warning mb-4 py-2 px-3 text-start\" style=\"font-size: 0.88rem;\">
                            Zalogowano jako: <strong>";
            // line 21
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 21), "fullname", [], "any", false, false, false, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 21), "fullname", [], "any", false, false, false, 21), "html", null, true)) : ($this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["grav"] ?? null), "user", [], "any", false, false, false, 21), "username", [], "any", false, false, false, 21), "html", null, true)));
            yield "</strong><br>
                            Twoje konto nie ma przypisanej odpowiedniej grupy lub roli.
                            ";
            // line 24
            yield "                            ";
            // line 28
            yield "                        </div>

                        <div class=\"d-flex flex-column gap-2\">
                            <a href=\"";
            // line 31
            yield (string) (((($context["base_url"] ?? null) == "")) ? ("/") : ($this->escaper->escape(($context["base_url"] ?? null), "html", null, true)));
            yield "\" class=\"btn hx-btn-primary w-100\">
                                Powrót do strony głównej
                            </a>
                            <a href=\"";
            // line 34
            yield (string) $this->escaper->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["uri"] ?? null), "addNonce", [((((($context["base_url_relative"] ?? null) . CoreExtension::getAttribute($this->env, $this->source, ($context["uri"] ?? null), "path", [], "any", false, false, false, 34)) . "/task") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "system", [], "any", false, false, false, 34), "param_sep", [], "any", false, false, false, 34)) . "login.logout"), "logout-form", "logout-nonce"], "method", false, false, false, 34), "html", null, true);
            yield "\" class=\"btn hx-btn-ghost w-100\">
                                Zaloguj na inne konto
                            </a>
                        </div>
                    ";
        } else {
            // line 39
            yield "                        <a href=\"";
            yield (string) $this->escaper->escape((($context["base_url_relative"] ?? null) . (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "plugins", [], "any", false, false, false, 39), "login", [], "any", false, false, false, 39), "route", [], "any", false, false, false, 39)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "plugins", [], "any", false, false, false, 39), "login", [], "any", false, false, false, 39), "route", [], "any", false, false, false, 39)) : ("/login"))), "html", null, true);
            yield "\" class=\"btn hx-btn-primary w-100\">
                            Zaloguj się
                        </a>
                    ";
        }
        // line 43
        yield "                </div>
            </div>

            <div class=\"container\" style=\"max-width:1050px\">
                ";
        // line 47
        yield from $this->load("partials/footer.html.twig", 47)->unwrap()->yield($context);
        // line 48
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
        return "unauthorized.html.twig";
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
        return array (  131 => 48,  129 => 47,  123 => 43,  115 => 39,  107 => 34,  101 => 31,  96 => 28,  94 => 24,  89 => 21,  86 => 20,  84 => 19,  69 => 6,  67 => 5,  64 => 4,  57 => 3,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27partials/base.html.twig\x27 %}

{% block body %}
    <div class=\"hx-shell\">
        {% include \x27partials/sidebar.html.twig\x27 %}

        <main class=\"hx-main d-flex flex-column min-vh-100\">
            <div class=\"hx-login-wrapper flex-grow-1\">
                <div class=\"hx-login-card text-center\">
                    <div class=\"hx-card-icon mx-auto mb-3\" style=\"width: 48px; height: 48px; line-height: 48px; font-size: 1.4rem; color: #ef5b5b; background: rgba(239, 91, 91, 0.12);\">
                        ✕
                    </div>

                    <h1 class=\"hx-login-title\">Brak dostępu</h1>
                    <p class=\"hx-login-subtitle mb-4\">
                        Nie posiadasz uprawnień wymaganych do przeglądania tych materiałów.
                    </p>

                    {% if grav.user.authenticated %}
                        <div class=\"alert alert-warning mb-4 py-2 px-3 text-start\" style=\"font-size: 0.88rem;\">
                            Zalogowano jako: <strong>{{ grav.user.fullname ?: grav.user.username }}</strong><br>
                            Twoje konto nie ma przypisanej odpowiedniej grupy lub roli.
                            {# <br><br> #}
                            {# <code style=\"font-size: 0.8rem;\">
                                <strong>Wymagane przez stronę:</strong> {{ page.header.access|json_encode }}<br>
                                <strong>Twoje uprawnienia:</strong> {{ grav.user.access|json_encode }}
                            </code> #}
                        </div>

                        <div class=\"d-flex flex-column gap-2\">
                            <a href=\"{{ base_url == \x27\x27 ? \x27/\x27 : base_url }}\" class=\"btn hx-btn-primary w-100\">
                                Powrót do strony głównej
                            </a>
                            <a href=\"{{ uri.addNonce(base_url_relative ~ uri.path ~ \x27/task\x27 ~ config.system.param_sep ~ \x27login.logout\x27, \x27logout-form\x27, \x27logout-nonce\x27) }}\" class=\"btn hx-btn-ghost w-100\">
                                Zaloguj na inne konto
                            </a>
                        </div>
                    {% else %}
                        <a href=\"{{ base_url_relative ~ (config.plugins.login.route ?: \x27/login\x27) }}\" class=\"btn hx-btn-primary w-100\">
                            Zaloguj się
                        </a>
                    {% endif %}
                </div>
            </div>

            <div class=\"container\" style=\"max-width:1050px\">
                {% include \x27partials/footer.html.twig\x27 %}
            </div>
        </main>
    </div>
{% endblock %}
", "unauthorized.html.twig", "/var/www/html/user/themes/helios-bs/templates/unauthorized.html.twig");
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
