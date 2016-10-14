<?php

namespace common\core;


/**
 * CheckboxColumn displays a column of checkboxes in a grid view.
 *
 */
class CheckboxColumn extends \yii\grid\CheckboxColumn
{
    /**
     * Renders the header cell content.
     * The default implementation simply renders [[header]].
     * This method may be overridden to customize the rendering of the header cell.
     * @return string the rendering result
     */
    protected function renderHeaderCellContent()
    {
        return '<label class="mt-checkbox mt-checkbox-outline" style="padding-left:19px;">'.parent::renderHeaderCellContent().'<span></span></label>';
    }

}
