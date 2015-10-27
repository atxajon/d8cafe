<?php

/* core/themes/classy/templates/misc/progress-bar.html.twig */
class __TwigTemplate_236b8089c19e5d297ee6bd8a3489e27a9b7fb44d9e59eec0b2e50ecbba1df862 extends Twig_Template
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
        // line 14
        echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->env->getExtension('drupal_core')->attachLibrary("classy/progress"), "html", null, true);
        echo "
<div class=\"progress\" data-drupal-progress>
  ";
        // line 16
        if ((isset($context["label"]) ? $context["label"] : null)) {
            // line 17
            echo "    <div class=\"progress__label\">";
            echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
            echo "</div>
  ";
        }
        // line 19
        echo "  <div class=\"progress__track\"><div class=\"progress__bar\" style=\"width: ";
        echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["percent"]) ? $context["percent"] : null), "html", null, true);
        echo "%\"></div></div>
  <div class=\"progress__percentage\">";
        // line 20
        echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["percent"]) ? $context["percent"] : null), "html", null, true);
        echo "%</div>
  <div class=\"progress__description\">";
        // line 21
        echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["message"]) ? $context["message"] : null), "html", null, true);
        echo "</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/misc/progress-bar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 21,  37 => 20,  32 => 19,  26 => 17,  24 => 16,  19 => 14,);
    }
}
/* {#*/
/* /***/
/*  * @file*/
/*  * Theme override for a progress bar.*/
/*  **/
/*  * Note that the core Batch API uses this only for non-JavaScript batch jobs.*/
/*  **/
/*  * Available variables:*/
/*  * - label: The label of the working task.*/
/*  * - percent: The percentage of the progress.*/
/*  * - message: A string containing information to be displayed.*/
/*  *//* */
/* #}*/
/* {{ attach_library('classy/progress') }}*/
/* <div class="progress" data-drupal-progress>*/
/*   {% if label %}*/
/*     <div class="progress__label">{{ label }}</div>*/
/*   {% endif %}*/
/*   <div class="progress__track"><div class="progress__bar" style="width: {{ percent }}%"></div></div>*/
/*   <div class="progress__percentage">{{ percent }}%</div>*/
/*   <div class="progress__description">{{ message }}</div>*/
/* </div>*/
/* */
