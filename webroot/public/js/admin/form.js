!function( $ ){

    "use strict";

    $(function () {

        /**
         * Delete attachment
         */
        $('.delete-attachment').click(function(){

            var field  = $(this).data('field'),
                id     = $(this).data('id'),
                table  = $(this).data('table'),
                data   = {},
                $this  = $(this),
                url    = '/api/' + table + '/' + id;

            if (! confirm('Delete ' + field + '?')) {
                return false;
            }

            data['id'] = id;
            data[field] = 'delete';

            $.ajax({
                type: 'PUT',
                url: url,
                data: data
            }).done(function() {
                $this.parent().remove();
            }).fail(function () {
                alertify.error('An error occurred while deleting attachment.');
            });

            return false;
        });

        /**
         * Selectize for select input
         */
        $('select#galleries').selectize();
        $('select#category_id').selectize();
        $('select#page_id').selectize();
        $('select#product_id').selectize();
        $('select#target').selectize();
        $('select#slideshowitems').selectize();
        $('select#colors').selectize();
        $('select#sizes').selectize();

        // landing pages module
        $('select#homePageBlocks').selectize();
        $('select#cards').selectize();

        //Failz landing page
        $('select#failzOptionsLeft').selectize();
        $('select#failzOptionsRight').selectize();

        // music landing pages module
        $('select#musicLandingPagePageBlocks').selectize();
        $('select#musicLandingPageCards').selectize();
        $('select#cardCoverBlocks').selectize();

        // insurance pages module
        $('select#insurancePageInsuranceBlocks').selectize();
        $('select#insurancePageInsuranceCards').selectize();

        // insurance landing - cover card blocks
        $('select#insuranceLandingCoverCardBlocks').selectize();

        /**
         * Selectize for tags
         */
        if ($('#tags').length) {
            $.ajax({
                type: 'GET',
                url: '/api/tags'
            }).done(function(data) {
                var tags = data.map(function(x) { return { item: x.tag }; });
                $('#tags').selectize({
                    persist: false,
                    create: true,
                    delimiter: ', ',
                    options: tags,
                    searchField: ['item'],
                    labelField: 'item',
                    valueField: 'item',
                    createOnBlur: true
                });
            }).fail(function () {
                alertify.error('An error occurred while getting tags.');
            });
        }

        /**
         * Set button in red on validation errors
         */
        var firstErrorTabActive = false;
        $('.tab-pane').each(function(index, el) {
            if ($(this).find('.has-error').length) {
                var tabButton = $('a[data-target="#' + $(this).attr('id') + '"]');
                if ( ! firstErrorTabActive) {
                    tabButton.tab('show');
                    firstErrorTabActive = true;
                }
                var dangerClass = 'text-danger';
                if (tabButton.hasClass('btn')) {
                    dangerClass = 'btn-danger';
                }
                tabButton.addClass(dangerClass);
            };
        });

        /**
         * Locale switcher : set active button
         */
        $('#btn-group-form-locales .btn').click(function(){
            $(this).parent().children('.active').removeClass('active');
            $(this).addClass('active');
        });

    });

}( window.jQuery || window.ender );

function copyLink(fileName, filePath) {
    if(fileName.length != 0){
        var selectedValue = window.prompt("Copy to clipboard: Ctrl+C", filePath);
        if (selectedValue != null) {
            try {
                document.execCommand('copy');
            } catch (err) {
                alert('Please press Ctrl/Cmd+C to copy.');
            }
        }
    } else {
        alert('Please upload file!');
    }
}