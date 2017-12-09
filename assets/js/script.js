app = {
    init: function () {
        this.kanban();
        this.modalToggle();
    },

    kanban: function () {
        $( ".kanban-sortable" ).sortable({
            revert: true,
            placeholder: 'drag-place-holder',
            forcePlaceholderSize: true,
            connectWith: ".kanban-sortable",
            helper:function(event, element){return $(element).clone().addClass('dragging');},
            start: function (e, ui) {ui.item.show().addClass('ghost')},
            stop: function (e, ui) { ui.item.show().removeClass('ghost')},
            cursor:'move'
        })
            .disableSelection();;
    },

    modalToggle: function () {
        $(document.body).on('click', '.open-modal', function () {
            $('.modal.' + $(this).attr('data-action')).addClass('is-active');
        });

        $(document.body).on('click', '.close-modal', function () {
           $(this).closest('.modal').removeClass('is-active');
        });
    },
};

app.init();