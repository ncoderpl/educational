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

/* @Page:/var/www/html/user/pages/02.psp */
class __TwigTemplate_c265b7a7c53b0d1c675eb24b912ff56f_sourced extends Template
{
    private Source $source;
    /**
     * @var array<string, MacroNamespace>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        $this->sandbox = $env->getExtension(SandboxExtension::class)->getChecker();
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<div class=\"md-alert md-alert--note\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-info inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm8-6.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13ZM6.5 7.75A.75.75 0 0 1 7.25 7h1a.75.75 0 0 1 .75.75v2.75h.25a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1 0-1.5h.25v-2h-.25a.75.75 0 0 1-.75-.75ZM8 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z\"></path></svg> Note</p>
<div class=\"md-alert-body\">
<p>Quark 2 is Grav 2.0\x27s default theme. It uses <a href=\"https://blades.ninja/\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">Blades CSS</a> (the actively maintained successor to Pico CSS) as a classless foundation, layered with a Cal.com-inspired design system. Full Blades capabilities are documented in the <a href=\"https://blades.ninja/#docs\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">Official Blades CSS Docs</a>.</p>
</div>
</div>
<p>The <a href=\"https://github.com/getgrav/grav-theme-quark2\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">Quark 2 theme</a> is Grav\x27s new default, replacing the long-serving Quark (1.x) theme. It pairs a pure-grayscale palette with <strong>Cal Sans</strong> for display and <strong>Inter</strong> for body text (both hosted locally), Font Awesome 7 icons, and auto/light/dark appearance that persists in the user\x27s browser. The layout system is CSS Grid + modern custom properties rather than a framework grid.</p>
<h3>Headings</h3>
<p>Quark 2 uses <strong>Cal Sans</strong> for display headings and treats <code>h1</code> / <code>h2</code> distinctly — <code>h1</code> sits at a lighter display weight while <code>h2</code> is bolder and gains a small accent bar to mark section breaks. <code>h6</code> is rendered as an uppercase eyebrow label.</p>
<h1>H1 Heading — airy, display weight</h1>
<h2>H2 Heading — confident, with accent bar</h2>
<h3>H3 Heading — workhorse section heading</h3>
<h4>H4 Heading</h4>
<h5>H5 Heading</h5>
<h6>H6 Heading — uppercase eyebrow</h6>
<pre><code class=\"language-markdown\"># H1 Heading
## H2 Heading
### H3 Heading
#### H4 Heading
##### H5 Heading
###### H6 Heading</code></pre>
<h3>Paragraphs</h3>
<p>Body copy is set in <strong>Inter</strong> at 16px with a 1.7 line-height and subtle tracking. Links adopt the theme\x27s <strong>accent color</strong> — by default a restrained charcoal, but configurable to any hex via <code>Themes → Quark 2 → Accent Color</code>.</p>
<p>Lorem ipsum dolor sit amet, consectetur <a href=\"#\">adipiscing elit. Praesent risus leo, dictum in vehicula sit amet</a>, feugiat tempus tellus. Duis quis sodales risus. Etiam euismod ornare consequat.</p>
<p>Climb leg rub face on everything give attitude nap all day for under the bed. Chase mice attack feet but rub face on everything hopped up on goofballs.</p>
<h3>Markdown Semantic Text Elements</h3>
<p><strong>Bold</strong> <code>**Bold**</code></p>
<p><em>Italic</em> <code>_Italic_</code></p>
<p><del>Deleted</del> <code>~~Deleted~~</code></p>
<p><code>Inline Code</code> <code>`Inline Code`</code></p>
<h3>HTML Semantic Text Elements</h3>
<p><abbr>I18N</abbr> <code>&lt;abbr&gt;</code></p>
<p><cite>Citation</cite> <code>&lt;cite&gt;</code></p>
<p><kbd>Ctrl + S</kbd> <code>&lt;kbd&gt;</code></p>
<p>Text<sup>Superscripted</sup> <code>&lt;sup&gt;</code></p>
<p>Text<sub>Subscripted</sub> <code>&lt;sub&gt;</code></p>
<p><u>Underlined</u> <code>&lt;u&gt;</code></p>
<p><mark>Highlighted</mark> <code>&lt;mark&gt;</code></p>
<p><time>20:14</time> <code>&lt;time&gt;</code></p>
<p><var>x = y + 2</var> <code>&lt;var&gt;</code></p>
<h3>Blockquote</h3>
<blockquote>
<p>The advance of technology is based on making it fit in so that you don\x27t really even notice it,
so it\x27s part of everyday life.</p>
<p><cite>- Bill Gates</cite></p>
</blockquote>
<pre><code class=\"language-markdown\">&gt; The advance of technology is based on making it fit in so that you don\x27t really even notice it,
&gt; so it\x27s part of everyday life.
&gt;
&gt; &lt;cite&gt;- Bill Gates&lt;/cite&gt;</code></pre>
<h3>Unordered List</h3>
<ul>
<li>list item 1</li>
<li>list item 2
<ul>
<li>list item 2.1</li>
<li>list item 2.2</li>
<li>list item 2.3</li>
</ul></li>
<li>list item 3</li>
</ul>
<pre><code class=\"language-markdown\">* list item 1
* list item 2
    * list item 2.1
    * list item 2.2
    * list item 2.3
* list item 3</code></pre>
<h3>Ordered List</h3>
<ol>
<li>list item 1</li>
<li>list item 2
<ol>
<li>list item 2.1</li>
<li>list item 2.2</li>
<li>list item 2.3</li>
</ol></li>
<li>list item 3</li>
</ol>
<pre><code class=\"language-markdown\">1. list item 1
1. list item 2
    1. list item 2.1
    1. list item 2.2
    1. list item 2.3
1. list item 3</code></pre>
<h3>Table</h3>
<table>
<thead>
<tr>
<th style=\"text-align: left;\">Name</th>
<th style=\"text-align: center;\">Genre</th>
<th style=\"text-align: right;\">Release date</th>
</tr>
</thead>
<tbody>
<tr>
<td style=\"text-align: left;\">The Shawshank Redemption</td>
<td style=\"text-align: center;\">Crime, Drama</td>
<td style=\"text-align: right;\">14 October 1994</td>
</tr>
<tr>
<td style=\"text-align: left;\">The Godfather</td>
<td style=\"text-align: center;\">Crime, Drama</td>
<td style=\"text-align: right;\">24 March 1972</td>
</tr>
<tr>
<td style=\"text-align: left;\">Schindler\x27s List</td>
<td style=\"text-align: center;\">Biography, Drama, History</td>
<td style=\"text-align: right;\">4 February 1994</td>
</tr>
<tr>
<td style=\"text-align: left;\">Se7en</td>
<td style=\"text-align: center;\">Crime, Drama, Mystery</td>
<td style=\"text-align: right;\">22 September 1995</td>
</tr>
</tbody>
</table>
<pre><code class=\"language-markdown\">| Name                        | Genre                         | Release date         |
| :-------------------------- | :---------------------------: | -------------------: |
| The Shawshank Redemption    | Crime, Drama                  | 14 October 1994      |
| The Godfather               | Crime, Drama                  | 24 March 1972        |
| Schindler\x27s List            | Biography, Drama, History     | 4 February 1994      |
| Se7en                       | Crime, Drama, Mystery         | 22 September 1995    |</code></pre>
<h3>Alerts</h3>
<p>Grav 2.0 replaces the legacy <code>markdown-notices</code> plugin with <a href=\"https://github.com/grav/grav-plugin-github-markdown-alerts\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">
  <code>github-markdown-alerts</code>
</a>, which renders <a href=\"https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax#alerts\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">GitHub-flavored Markdown alerts</a>. Five types are available, each with an accent stripe, icon, and label:</p>
<div class=\"md-alert md-alert--note\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-info inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm8-6.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13ZM6.5 7.75A.75.75 0 0 1 7.25 7h1a.75.75 0 0 1 .75.75v2.75h.25a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1 0-1.5h.25v-2h-.25a.75.75 0 0 1-.75-.75ZM8 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z\"></path></svg> Note</p>
<div class=\"md-alert-body\">
<p>Highlights information that users should take into account, even when skimming.</p>
</div>
</div>
<div class=\"md-alert md-alert--tip\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-light-bulb inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M8 1.5c-2.363 0-4 1.69-4 3.75 0 .984.424 1.625.984 2.304l.214.253c.223.264.47.556.673.848.284.411.537.896.621 1.49a.75.75 0 0 1-1.484.211c-.04-.282-.163-.547-.37-.847a8.456 8.456 0 0 0-.542-.68c-.084-.1-.173-.205-.268-.32C3.201 7.75 2.5 6.766 2.5 5.25 2.5 2.31 4.863 0 8 0s5.5 2.31 5.5 5.25c0 1.516-.701 2.5-1.328 3.259-.095.115-.184.22-.268.319-.207.245-.383.453-.541.681-.208.3-.33.565-.37.847a.751.751 0 0 1-1.485-.212c.084-.593.337-1.078.621-1.489.203-.292.45-.584.673-.848.075-.088.147-.173.213-.253.561-.679.985-1.32.985-2.304 0-2.06-1.637-3.75-4-3.75ZM5.75 12h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1 0-1.5ZM6 15.25a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75Z\"></path></svg> Tip</p>
<div class=\"md-alert-body\">
<p>Optional information to help a user be more successful.</p>
</div>
</div>
<div class=\"md-alert md-alert--important\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-report inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M0 1.75C0 .784.784 0 1.75 0h12.5C15.216 0 16 .784 16 1.75v9.5A1.75 1.75 0 0 1 14.25 13H8.06l-2.573 2.573A1.458 1.458 0 0 1 3 14.543V13H1.75A1.75 1.75 0 0 1 0 11.25Zm1.75-.25a.25.25 0 0 0-.25.25v9.5c0 .138.112.25.25.25h2a.75.75 0 0 1 .75.75v2.19l2.72-2.72a.749.749 0 0 1 .53-.22h6.5a.25.25 0 0 0 .25-.25v-9.5a.25.25 0 0 0-.25-.25Zm7 2.25v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z\"></path></svg> Important</p>
<div class=\"md-alert-body\">
<p>Crucial information necessary for users to succeed.</p>
</div>
</div>
<div class=\"md-alert md-alert--warning\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-alert inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z\"></path></svg> Warning</p>
<div class=\"md-alert-body\">
<p>Critical content demanding immediate user attention due to potential risks.</p>
</div>
</div>
<div class=\"md-alert md-alert--caution\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-stop inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M4.47.22A.749.749 0 0 1 5 0h6c.199 0 .389.079.53.22l4.25 4.25c.141.14.22.331.22.53v6a.749.749 0 0 1-.22.53l-4.25 4.25A.749.749 0 0 1 11 16H5a.749.749 0 0 1-.53-.22L.22 11.53A.749.749 0 0 1 0 11V5c0-.199.079-.389.22-.53Zm.84 1.28L1.5 5.31v5.38l3.81 3.81h5.38l3.81-3.81V5.31L10.69 1.5ZM8 4a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z\"></path></svg> Caution</p>
<div class=\"md-alert-body\">
<p>Negative potential consequences of an action.</p>
</div>
</div>
<pre><code class=\"language-markdown\">&gt; [!NOTE]
&gt; Highlights information that users should take into account, even when skimming.

&gt; [!TIP]
&gt; Optional information to help a user be more successful.

&gt; [!IMPORTANT]
&gt; Crucial information necessary for users to succeed.

&gt; [!WARNING]
&gt; Critical content demanding immediate user attention due to potential risks.

&gt; [!CAUTION]
&gt; Negative potential consequences of an action.</code></pre>";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@Page:/var/www/html/user/pages/02.psp";
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
        return array (  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"md-alert md-alert--note\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-info inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm8-6.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13ZM6.5 7.75A.75.75 0 0 1 7.25 7h1a.75.75 0 0 1 .75.75v2.75h.25a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1 0-1.5h.25v-2h-.25a.75.75 0 0 1-.75-.75ZM8 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z\"></path></svg> Note</p>
<div class=\"md-alert-body\">
<p>Quark 2 is Grav 2.0\x27s default theme. It uses <a href=\"https://blades.ninja/\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">Blades CSS</a> (the actively maintained successor to Pico CSS) as a classless foundation, layered with a Cal.com-inspired design system. Full Blades capabilities are documented in the <a href=\"https://blades.ninja/#docs\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">Official Blades CSS Docs</a>.</p>
</div>
</div>
<p>The <a href=\"https://github.com/getgrav/grav-theme-quark2\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">Quark 2 theme</a> is Grav\x27s new default, replacing the long-serving Quark (1.x) theme. It pairs a pure-grayscale palette with <strong>Cal Sans</strong> for display and <strong>Inter</strong> for body text (both hosted locally), Font Awesome 7 icons, and auto/light/dark appearance that persists in the user\x27s browser. The layout system is CSS Grid + modern custom properties rather than a framework grid.</p>
<h3>Headings</h3>
<p>Quark 2 uses <strong>Cal Sans</strong> for display headings and treats <code>h1</code> / <code>h2</code> distinctly — <code>h1</code> sits at a lighter display weight while <code>h2</code> is bolder and gains a small accent bar to mark section breaks. <code>h6</code> is rendered as an uppercase eyebrow label.</p>
<h1>H1 Heading — airy, display weight</h1>
<h2>H2 Heading — confident, with accent bar</h2>
<h3>H3 Heading — workhorse section heading</h3>
<h4>H4 Heading</h4>
<h5>H5 Heading</h5>
<h6>H6 Heading — uppercase eyebrow</h6>
<pre><code class=\"language-markdown\"># H1 Heading
## H2 Heading
### H3 Heading
#### H4 Heading
##### H5 Heading
###### H6 Heading</code></pre>
<h3>Paragraphs</h3>
<p>Body copy is set in <strong>Inter</strong> at 16px with a 1.7 line-height and subtle tracking. Links adopt the theme\x27s <strong>accent color</strong> — by default a restrained charcoal, but configurable to any hex via <code>Themes → Quark 2 → Accent Color</code>.</p>
<p>Lorem ipsum dolor sit amet, consectetur <a href=\"#\">adipiscing elit. Praesent risus leo, dictum in vehicula sit amet</a>, feugiat tempus tellus. Duis quis sodales risus. Etiam euismod ornare consequat.</p>
<p>Climb leg rub face on everything give attitude nap all day for under the bed. Chase mice attack feet but rub face on everything hopped up on goofballs.</p>
<h3>Markdown Semantic Text Elements</h3>
<p><strong>Bold</strong> <code>**Bold**</code></p>
<p><em>Italic</em> <code>_Italic_</code></p>
<p><del>Deleted</del> <code>~~Deleted~~</code></p>
<p><code>Inline Code</code> <code>`Inline Code`</code></p>
<h3>HTML Semantic Text Elements</h3>
<p><abbr>I18N</abbr> <code>&lt;abbr&gt;</code></p>
<p><cite>Citation</cite> <code>&lt;cite&gt;</code></p>
<p><kbd>Ctrl + S</kbd> <code>&lt;kbd&gt;</code></p>
<p>Text<sup>Superscripted</sup> <code>&lt;sup&gt;</code></p>
<p>Text<sub>Subscripted</sub> <code>&lt;sub&gt;</code></p>
<p><u>Underlined</u> <code>&lt;u&gt;</code></p>
<p><mark>Highlighted</mark> <code>&lt;mark&gt;</code></p>
<p><time>20:14</time> <code>&lt;time&gt;</code></p>
<p><var>x = y + 2</var> <code>&lt;var&gt;</code></p>
<h3>Blockquote</h3>
<blockquote>
<p>The advance of technology is based on making it fit in so that you don\x27t really even notice it,
so it\x27s part of everyday life.</p>
<p><cite>- Bill Gates</cite></p>
</blockquote>
<pre><code class=\"language-markdown\">&gt; The advance of technology is based on making it fit in so that you don\x27t really even notice it,
&gt; so it\x27s part of everyday life.
&gt;
&gt; &lt;cite&gt;- Bill Gates&lt;/cite&gt;</code></pre>
<h3>Unordered List</h3>
<ul>
<li>list item 1</li>
<li>list item 2
<ul>
<li>list item 2.1</li>
<li>list item 2.2</li>
<li>list item 2.3</li>
</ul></li>
<li>list item 3</li>
</ul>
<pre><code class=\"language-markdown\">* list item 1
* list item 2
    * list item 2.1
    * list item 2.2
    * list item 2.3
* list item 3</code></pre>
<h3>Ordered List</h3>
<ol>
<li>list item 1</li>
<li>list item 2
<ol>
<li>list item 2.1</li>
<li>list item 2.2</li>
<li>list item 2.3</li>
</ol></li>
<li>list item 3</li>
</ol>
<pre><code class=\"language-markdown\">1. list item 1
1. list item 2
    1. list item 2.1
    1. list item 2.2
    1. list item 2.3
1. list item 3</code></pre>
<h3>Table</h3>
<table>
<thead>
<tr>
<th style=\"text-align: left;\">Name</th>
<th style=\"text-align: center;\">Genre</th>
<th style=\"text-align: right;\">Release date</th>
</tr>
</thead>
<tbody>
<tr>
<td style=\"text-align: left;\">The Shawshank Redemption</td>
<td style=\"text-align: center;\">Crime, Drama</td>
<td style=\"text-align: right;\">14 October 1994</td>
</tr>
<tr>
<td style=\"text-align: left;\">The Godfather</td>
<td style=\"text-align: center;\">Crime, Drama</td>
<td style=\"text-align: right;\">24 March 1972</td>
</tr>
<tr>
<td style=\"text-align: left;\">Schindler\x27s List</td>
<td style=\"text-align: center;\">Biography, Drama, History</td>
<td style=\"text-align: right;\">4 February 1994</td>
</tr>
<tr>
<td style=\"text-align: left;\">Se7en</td>
<td style=\"text-align: center;\">Crime, Drama, Mystery</td>
<td style=\"text-align: right;\">22 September 1995</td>
</tr>
</tbody>
</table>
<pre><code class=\"language-markdown\">| Name                        | Genre                         | Release date         |
| :-------------------------- | :---------------------------: | -------------------: |
| The Shawshank Redemption    | Crime, Drama                  | 14 October 1994      |
| The Godfather               | Crime, Drama                  | 24 March 1972        |
| Schindler\x27s List            | Biography, Drama, History     | 4 February 1994      |
| Se7en                       | Crime, Drama, Mystery         | 22 September 1995    |</code></pre>
<h3>Alerts</h3>
<p>Grav 2.0 replaces the legacy <code>markdown-notices</code> plugin with <a href=\"https://github.com/grav/grav-plugin-github-markdown-alerts\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">
  <code>github-markdown-alerts</code>
</a>, which renders <a href=\"https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax#alerts\" target=\"_blank\" rel=\"nofollow noopener noreferrer\" class=\"external-link no-image\">GitHub-flavored Markdown alerts</a>. Five types are available, each with an accent stripe, icon, and label:</p>
<div class=\"md-alert md-alert--note\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-info inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm8-6.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13ZM6.5 7.75A.75.75 0 0 1 7.25 7h1a.75.75 0 0 1 .75.75v2.75h.25a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1 0-1.5h.25v-2h-.25a.75.75 0 0 1-.75-.75ZM8 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z\"></path></svg> Note</p>
<div class=\"md-alert-body\">
<p>Highlights information that users should take into account, even when skimming.</p>
</div>
</div>
<div class=\"md-alert md-alert--tip\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-light-bulb inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M8 1.5c-2.363 0-4 1.69-4 3.75 0 .984.424 1.625.984 2.304l.214.253c.223.264.47.556.673.848.284.411.537.896.621 1.49a.75.75 0 0 1-1.484.211c-.04-.282-.163-.547-.37-.847a8.456 8.456 0 0 0-.542-.68c-.084-.1-.173-.205-.268-.32C3.201 7.75 2.5 6.766 2.5 5.25 2.5 2.31 4.863 0 8 0s5.5 2.31 5.5 5.25c0 1.516-.701 2.5-1.328 3.259-.095.115-.184.22-.268.319-.207.245-.383.453-.541.681-.208.3-.33.565-.37.847a.751.751 0 0 1-1.485-.212c.084-.593.337-1.078.621-1.489.203-.292.45-.584.673-.848.075-.088.147-.173.213-.253.561-.679.985-1.32.985-2.304 0-2.06-1.637-3.75-4-3.75ZM5.75 12h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1 0-1.5ZM6 15.25a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75Z\"></path></svg> Tip</p>
<div class=\"md-alert-body\">
<p>Optional information to help a user be more successful.</p>
</div>
</div>
<div class=\"md-alert md-alert--important\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-report inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M0 1.75C0 .784.784 0 1.75 0h12.5C15.216 0 16 .784 16 1.75v9.5A1.75 1.75 0 0 1 14.25 13H8.06l-2.573 2.573A1.458 1.458 0 0 1 3 14.543V13H1.75A1.75 1.75 0 0 1 0 11.25Zm1.75-.25a.25.25 0 0 0-.25.25v9.5c0 .138.112.25.25.25h2a.75.75 0 0 1 .75.75v2.19l2.72-2.72a.749.749 0 0 1 .53-.22h6.5a.25.25 0 0 0 .25-.25v-9.5a.25.25 0 0 0-.25-.25Zm7 2.25v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z\"></path></svg> Important</p>
<div class=\"md-alert-body\">
<p>Crucial information necessary for users to succeed.</p>
</div>
</div>
<div class=\"md-alert md-alert--warning\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-alert inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z\"></path></svg> Warning</p>
<div class=\"md-alert-body\">
<p>Critical content demanding immediate user attention due to potential risks.</p>
</div>
</div>
<div class=\"md-alert md-alert--caution\" dir=\"auto\">
<p class=\"md-alert-title\"><svg class=\"octicon octicon-stop inline-block \" viewBox=\"0 0 16 16\" version=\"1.1\" width=\"16\" height=\"16\" aria-hidden=\"true\"><path d=\"M4.47.22A.749.749 0 0 1 5 0h6c.199 0 .389.079.53.22l4.25 4.25c.141.14.22.331.22.53v6a.749.749 0 0 1-.22.53l-4.25 4.25A.749.749 0 0 1 11 16H5a.749.749 0 0 1-.53-.22L.22 11.53A.749.749 0 0 1 0 11V5c0-.199.079-.389.22-.53Zm.84 1.28L1.5 5.31v5.38l3.81 3.81h5.38l3.81-3.81V5.31L10.69 1.5ZM8 4a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z\"></path></svg> Caution</p>
<div class=\"md-alert-body\">
<p>Negative potential consequences of an action.</p>
</div>
</div>
<pre><code class=\"language-markdown\">&gt; [!NOTE]
&gt; Highlights information that users should take into account, even when skimming.

&gt; [!TIP]
&gt; Optional information to help a user be more successful.

&gt; [!IMPORTANT]
&gt; Crucial information necessary for users to succeed.

&gt; [!WARNING]
&gt; Critical content demanding immediate user attention due to potential risks.

&gt; [!CAUTION]
&gt; Negative potential consequences of an action.</code></pre>", "@Page:/var/www/html/user/pages/02.psp", "");
    }
    
    public function ensureSecurityChecked(): void
    {
        if ($this->sandbox->isSandboxed($this->source)) {
            $this->checkSecurity();
        }
    }
    
    public function checkSecurity()
    {
        static $tags = [];
        static $filters = [];
        static $functions = [];
        static $tests = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
                [],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            } elseif ($e instanceof SecurityNotAllowedTestError && isset($tests[$e->getTestName()])) {
                $e->setTemplateLine($tests[$e->getTestName()]);
            }

            throw $e;
        }

    }
}
