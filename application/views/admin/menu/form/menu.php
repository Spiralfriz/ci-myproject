<?php
$roles = [
    1 => 'SUPER_ADMIN',
    2 => 'ADMIN',
    3 => 'USER'
];

echo form_open('menu/add', ['id' => 'menu']);

echo '<div class="form-group">';
    echo form_label('Name : ');
    echo form_input(['name' => 'name', 'value' => set_value('name'), 'class' => 'form-control']);
    echo form_error('name', ' <span class="help-block">', '</span>');
echo '</div>';

echo '<div class="form-group">';
    echo form_button(['name' => 'add_item', 'class' => 'btn btn-success'], 'Add item');
echo '</div>';

?>
<div id="item-content" class="hidden">
    <div class="form-group">
        <div class="input-group" data-ref="0">
            <input type="text" name="item[][name]" class="form-control menu-item" required="required">
            <span class="input-group-btn">
                <button type="button" name="delete_item" class="btn btn-danger">
                    <span class="fa fa-remove"></span>
                </button>
            </span>
            <button type="button" class="btn btn-success dropdown-toggle" style="margin-left:10px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                Roles
            </button>
            <ul class="dropdown-menu">
                <?php
                if(isset($roles)) {
                    foreach($roles as $id => $name) {
                        echo ' <div class="checkbox" style="margin-left: 10px;">
                            <label><input type="checkbox" name="" value="'.$id.'">&nbsp;'.$name.'</label>
                        </div>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php
echo '<div class="form-group" style="text-align: right;">';
    echo form_submit(['name' => 'menu', 'class' => 'btn btn-primary'], 'Save');
echo '</div>';

echo form_close();
?>
<script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>

<script type="text/javascript">
    "use strict";

    $(function () {
        var inc = 0;
        var $item = $('#item-content'); // global selector
        var template = $item.html(); //copy inside div#item-content

        // Events
        $('button[name="add_item"]').on('click', function () {
            createElement();
            $item.removeClass('hidden');
        });

        $(document).on('click', 'button[name="delete_item"]', function () {
            removeElement(this);
        });

        $(document).on('change', 'form#menu :checkbox', function () {
            if ($(this).is(':checked')) {

               var ref =  $(this)
                    .closest( ".form-group").children().attr('data-ref');

               $(this).attr('name', 'item['+ref+'][role-'+$(this).val()+']');

             //console.log(ref);

            } else {
                //console.log($(this).val() + ' is now unchecked');

               // $(this).attr('name', 'item['+inc+']['+$(this).value+']');
            }
        });



        // Functions
        function createElement()
        {
            if(inc > 0) {

                $item.append(template); // duplicated template
                $('#item-content div:last-child .input-group').attr('data-ref', inc);
            }

            inc++;
        }

        function removeElement($btn)
        {
            if(inc > 0)
            {
                $btn.closest('div').remove();
            }

            inc--;
        }
    });
</script>


