<?php

/* core/modules/system/templates/maintenance-task-list.html.twig */
class __TwigTemplate_cd3b51d5e431feaff5f8757249ed6535a5a90673e098384623770e0efbde7aab extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 17
        echo "<h2 class=\"visually-hidden\">";
        echo $this->env->getExtension('drupal_core')->renderVar(t("Installation tasks"));
        echo "</h2>
<ol class=\"task-list\">
";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tasks"]) ? $context["tasks"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["task"]) {
            // line 20
            echo "  <li";
            echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["task"], "attributes", array()), "html", null, true);
            echo ">
    ";
            // line 21
            echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["task"], "item", array()), "html", null, true);
            echo "
    ";
            // line 22
            if ($this->getAttribute($context["task"], "status", array())) {
                echo "<span class=\"visually-hidden\"> (";
                echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["task"], "status", array()), "html", null, true);
                echo ")</span>";
            }
            // line 23
            echo "  </li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "</ol>
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/maintenance-task-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 25,  44 => 23,  38 => 22,  34 => 21,  29 => 20,  25 => 19,  19 => 17,);
    }
}
/* {#*/
/* /***/
/*  * @file*/
/*  * Default theme implementation for a list of maintenance tasks to perform.*/
/*  **/
/*  * Available variables:*/
/*  * - tasks: A list of maintenance tasks to perform. Each item in the list has*/
/*  *   the following variables:*/
/*  *   - item: The maintenance task.*/
/*  *   - attributes: HTML attributes for the maintenance task.*/
/*  *   - status: (optional) Text describing the status of the maintenance task,*/
/*  *     'active' or 'done'.*/
/*  **/
/*  * @ingroup themeable*/
/*  *//* */
/* #}*/
/* <h2 class="visually-hidden">{{ 'Installation tasks'|t }}</h2>*/
/* <ol class="task-list">*/
/* {% for task in tasks %}*/
/*   <li{{ task.attributes }}>*/
/*     {{ task.item }}*/
/*     {% if task.status %}<span class="visually-hidden"> ({{ task.status }})</span>{% endif %}*/
/*   </li>*/
/* {% endfor %}*/
/* </ol>*/
/* */
