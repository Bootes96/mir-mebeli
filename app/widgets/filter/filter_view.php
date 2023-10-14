<?php foreach($this->groups as $group_id => $group_item): ?>
    <ul class="category-filters">
        <li class="category-filter_item">
          <div class="tags">
            <h4><?= $group_item['title'];?></h4>
            <?php if(!empty($this->attrs[$group_item['attribute_group_id']])) : ?>
            <?php foreach($this->attrs[$group_item['attribute_group_id']] as $attr_id => $value): ?>
            <?php if(!empty($filter) && in_array($attr_id, $filter)) {
              $checked = ' checked';
            } else {
              $checked = null;
            }?>
            <label class="checkbox">
              <input type="checkbox" name="checkbox" value="<?=$attr_id;?>" <?= $checked;?>>
              <?=$value;?>
            </label>
            <?php endforeach;?>
            <?php endif;?>
          </div>
        </li>
      </ul> 
<?php endforeach;?>