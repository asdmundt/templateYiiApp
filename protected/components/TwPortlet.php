<?php


/**
 * Description of TwPortlet
 *
 * @author asdmundt
 */
Yii::import('zii.widgets.CPortlet');

class TwPortlet extends CPortlet {

    /**
     * items of buttons
     * 
     */
    public $buttons = array();

    /**
     * items of buttons
     * 
     */
    public $linkOptions = array();

    public function init() {
        parent::init();
        $this->linkOptions = array('class' => 'btn btn-small');
    }

    /**
     * Renders the decoration for the portlet.
     * The default implementation will render the title if it is set.
     */
    protected function renderDecoration() {
        if ($this->title === null) {
            $this->title = "&nbsp;&nbsp;";
        }
        echo "<div class=\"{$this->decorationCssClass}\">\n";
        echo "<div class=\"{$this->titleCssClass}\">{$this->title}</div>\n";
        echo "<div class=\"toolbar_right\">\n";
        echo "<div class=\"btn-group\">\n";
        foreach ($this->buttons as $item) {
            $this->renderMenuItem($item);
        }
        echo "</div>\n";
        echo "</div>\n";
        echo "</div>\n";
    }

    /**
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     * @param array $item the menu item to be rendered. Please see {@link items} on what data might be in the item.
     * @return string
     * @since 1.1.6
     */
    protected function renderMenuItem($item) {
        echo CHtml::link($item['label'], $item['url'], $this->linkOptions);
    }

}
?>






