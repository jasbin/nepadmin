$('#edit').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget) // Button that triggered the modal
    //var title = button.data('mytitle')
    //const title = button.data('mybody')
    const id = button.data('myid')
    const route = button.data('route') + '/'

    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    const modal = $(this)

    $.ajax({
        url: route + id,
        method: 'GET',
        success: function(data){
            //check if status true or false -- true means data is there else not
            if(data.status){
                modal.find('.modal-body #category_id').val(data.result.id)
                modal.find('.modal-body #title').val(data.result.title)
                modal.find('.modal-body #body').val(data.result.description)
            }
        }
    });

  })

  $('#delete').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget) // Button that triggered the modal
    const id = button.data('myid')
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    const modal = $(this)
    modal.find('.modal-body #category_id').val(id)
  })
