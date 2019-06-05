<?php

/* C:\xampp\htdocs\git\onlinepos\vendor\cakephp\bake\src\Template\Bake\\tests\test_case.twig */
class __TwigTemplate_b049d87ee49dfbcfe30f2b86f4d9edc079bb0091ee7b3694f90ae83971bba806 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 18
        $context["isController"] = (twig_lower_filter($this->env, ($context["type"] ?? null)) == "controller");
        // line 19
        $context["isShell"] = (twig_lower_filter($this->env, ($context["type"] ?? null)) == "shell");
        // line 20
        $context["isCommand"] = (twig_lower_filter($this->env, ($context["type"] ?? null)) == "command");
        // line 21
        if (($context["isController"] ?? null)) {
            // line 22
            $context["traitName"] = "IntegrationTestTrait";
        } elseif ((        // line 23
($context["isShell"] ?? null) || ($context["isCommand"] ?? null))) {
            // line 24
            $context["traitName"] = "ConsoleIntegrationTestTrait";
        }
        // line 26
        $context["uses"] = twig_array_merge(($context["uses"] ?? null), [0 => "Cake\\TestSuite\\TestCase"]);
        // line 27
        if (($context["traitName"] ?? null)) {
            // line 28
            $context["uses"] = twig_array_merge(($context["uses"] ?? null), [0 => ("Cake\\TestSuite\\" . ($context["traitName"] ?? null))]);
        }
        // line 31
        $context["uses"] = twig_sort_filter(($context["uses"] ?? null));
        // line 32
        echo "<?php
namespace ";
        // line 33
        echo twig_escape_filter($this->env, ($context["baseNamespace"] ?? null), "html", null, true);
        echo "\\Test\\TestCase\\";
        echo twig_escape_filter($this->env, ($context["subNamespace"] ?? null), "html", null, true);
        echo ";

";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["uses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["dependency"]) {
            // line 36
            echo "use ";
            echo twig_escape_filter($this->env, $context["dependency"], "html", null, true);
            echo ";
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dependency'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "
/**
 * ";
        // line 40
        echo twig_escape_filter($this->env, ($context["fullClassName"] ?? null), "html", null, true);
        echo " Test Case
 */
class ";
        // line 42
        echo twig_escape_filter($this->env, ($context["className"] ?? null), "html", null, true);
        echo "Test extends TestCase
{
";
        // line 44
        if (($context["traitName"] ?? null)) {
            // line 45
            echo "    use ";
            echo twig_escape_filter($this->env, ($context["traitName"] ?? null), "html", null, true);
            echo ";
";
        }
        // line 47
        if (($context["properties"] ?? null)) {
            // line 48
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["properties"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["propertyInfo"]) {
                // line 49
                echo "
    /**
     * ";
                // line 51
                echo twig_escape_filter($this->env, $this->getAttribute($context["propertyInfo"], "description", []), "html", null, true);
                echo "
     *
     * @var ";
                // line 53
                echo twig_escape_filter($this->env, $this->getAttribute($context["propertyInfo"], "type", []), "html", null, true);
                echo "
     */
    public \$";
                // line 55
                echo twig_escape_filter($this->env, $this->getAttribute($context["propertyInfo"], "name", []), "html", null, true);
                if (($this->getAttribute($context["propertyInfo"], "value", [], "any", true, true) && $this->getAttribute($context["propertyInfo"], "value", []))) {
                    echo " = ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["propertyInfo"], "value", []), "html", null, true);
                }
                echo ";
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['propertyInfo'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 59
        if (($context["fixtures"] ?? null)) {
            // line 60
            echo "
    /**
     * Fixtures
     *
     * @var array
     */
    public \$fixtures = [";
            // line 66
            echo $this->getAttribute(($context["Bake"] ?? null), "stringifyList", [0 => $this->env->getExtension('Jasny\Twig\ArrayExtension')->values(($context["fixtures"] ?? null))], "method");
            echo "];
";
        }
        // line 69
        if (($context["construction"] ?? null)) {
            // line 70
            echo "
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
";
            // line 79
            if (($context["preConstruct"] ?? null)) {
                // line 80
                echo "        ";
                echo ($context["preConstruct"] ?? null);
                echo "
";
            }
            // line 82
            if (($context["isCommand"] ?? null)) {
                // line 83
                echo "        ";
                echo ($context["construction"] ?? null);
                echo "
";
            } else {
                // line 85
                echo "        \$this->";
                echo ((($context["subject"] ?? null) . " = ") . ($context["construction"] ?? null));
                echo "
";
            }
            // line 87
            if (($context["postConstruct"] ?? null)) {
                // line 88
                echo "        ";
                echo ($context["postConstruct"] ?? null);
                echo "
";
            }
            // line 90
            echo "    }
";
            // line 91
            if ( !($context["isCommand"] ?? null)) {
                // line 92
                echo "
    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset(\$this->";
                // line 100
                echo twig_escape_filter($this->env, ($context["subject"] ?? null), "html", null, true);
                echo ");

        parent::tearDown();
    }
";
            }
        }
        // line 107
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["methods"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 108
            echo "
    /**
     * Test ";
            // line 110
            echo twig_escape_filter($this->env, $context["method"], "html", null, true);
            echo " method
     *
     * @return void
     */
    public function test";
            // line 114
            echo twig_escape_filter($this->env, Cake\Utility\Inflector::camelize($context["method"]), "html", null, true);
            echo "()
    {
        \$this->markTestIncomplete('Not implemented yet.');
    }
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 120
        if ( !($context["methods"] ?? null)) {
            // line 121
            echo "
    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        \$this->markTestIncomplete('Not implemented yet.');
    }
";
        }
        // line 132
        echo "}
";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\git\\onlinepos\\vendor\\cakephp\\bake\\src\\Template\\Bake\\\\tests\\test_case.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  244 => 132,  231 => 121,  229 => 120,  218 => 114,  211 => 110,  207 => 108,  203 => 107,  194 => 100,  184 => 92,  182 => 91,  179 => 90,  173 => 88,  171 => 87,  165 => 85,  159 => 83,  157 => 82,  151 => 80,  149 => 79,  138 => 70,  136 => 69,  131 => 66,  123 => 60,  121 => 59,  108 => 55,  103 => 53,  98 => 51,  94 => 49,  90 => 48,  88 => 47,  82 => 45,  80 => 44,  75 => 42,  70 => 40,  66 => 38,  57 => 36,  53 => 35,  46 => 33,  43 => 32,  41 => 31,  38 => 28,  36 => 27,  34 => 26,  31 => 24,  29 => 23,  27 => 22,  25 => 21,  23 => 20,  21 => 19,  19 => 18,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#
/**
 * Test Case bake template
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
#}
{% set isController = type|lower == 'controller' %}
{% set isShell = type|lower == 'shell' %}
{% set isCommand = type|lower == 'command' %}
{% if isController %}
    {%- set traitName = 'IntegrationTestTrait' %}
{% elseif isShell or isCommand %}
    {%- set traitName = 'ConsoleIntegrationTestTrait' %}
{% endif %}
{%- set uses = uses|merge([\"Cake\\\\TestSuite\\\\TestCase\"]) %}
{% if traitName %}
    {%- set uses = uses|merge([\"Cake\\\\TestSuite\\\\#{traitName}\"]) %}
{% endif %}

{%- set uses = uses|sort %}
<?php
namespace {{ baseNamespace }}\\Test\\TestCase\\{{ subNamespace }};

{% for dependency in uses %}
use {{ dependency }};
{% endfor %}

/**
 * {{ fullClassName }} Test Case
 */
class {{ className }}Test extends TestCase
{
{% if traitName %}
    use {{ traitName }};
{% endif %}
{% if properties %}
{% for propertyInfo in properties %}

    /**
     * {{ propertyInfo.description }}
     *
     * @var {{ propertyInfo.type }}
     */
    public \${{ propertyInfo.name }}{% if propertyInfo.value is defined and propertyInfo.value %} = {{ propertyInfo.value }}{% endif %};
{% endfor %}
{% endif %}

{%- if fixtures %}

    /**
     * Fixtures
     *
     * @var array
     */
    public \$fixtures = [{{ Bake.stringifyList(fixtures|values)|raw }}];
{% endif %}

{%- if construction %}

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
{% if preConstruct %}
        {{ preConstruct|raw }}
{% endif %}
{% if isCommand %}
        {{ construction|raw }}
{% else %}
        \$this->{{ (subject ~ ' = ' ~ construction)|raw }}
{% endif %}
{% if postConstruct %}
        {{ postConstruct|raw }}
{% endif %}
    }
{% if not isCommand %}

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset(\$this->{{ subject }});

        parent::tearDown();
    }
{% endif %}
{% endif %}

{%- for method in methods %}

    /**
     * Test {{ method }} method
     *
     * @return void
     */
    public function test{{ method|camelize }}()
    {
        \$this->markTestIncomplete('Not implemented yet.');
    }
{% endfor %}

{%- if not methods %}

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        \$this->markTestIncomplete('Not implemented yet.');
    }
{% endif %}
}
", "C:\\xampp\\htdocs\\git\\onlinepos\\vendor\\cakephp\\bake\\src\\Template\\Bake\\\\tests\\test_case.twig", "C:\\xampp\\htdocs\\git\\onlinepos\\vendor\\cakephp\\bake\\src\\Template\\Bake\\\\tests\\test_case.twig");
    }
}
