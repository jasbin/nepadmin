$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var title = button.data('mytitle')
    var body = button.data('mybody')
    var id = button.data('myid')
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-body #post_id').val(id)
    modal.find('.modal-body #title').val(title)
    modal.find('.modal-body #body').val(body)

  })

  $('#delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('myid')
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-body #post_id').val(id)
  })

// //make link active
// $(".nav a p").on("click", function() {
//     $(".nav").find(".active").removeClass("active");
//     $(this).parent().addClass("active");
// });
// $(".nav-sidebar").on("click", ".nav-link", function(e) {
//     e.preventDefault();
//     $(".nav-link").removeClass("active");
//     $(this).addClass("active");
//   });
