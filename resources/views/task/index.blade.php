<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <div class="search">
            <h3 class="text-center title-color">Drag and Drop Datatables Using jQuery UI Sortable - Demo </h3>
            <p>&nbsp;</p>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <ul id="sortable" class="list-group">
                        @foreach($tasks as $task)
                            <li class="list-group-item" data-id="{{ $task->id }}">
                                {{ $task->title }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div> 
            <hr>
            <h5>Drag and Drop the table rows and <button class="btn btn-default" onclick="window.location.reload()"><b>REFRESH</b></button> the page to check the Demo. For the complete tutorial of how to make this demo app visit the following <a href="#">Link</a>.</h5> 
        </div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>

    <script type="text/javascript">
        $( function() {
            $( "#sortable" ).sortable({
                items: 'li',
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendTaskOrderToServer('#sortable li');
                }
            });
            $( "#sortable" ).disableSelection();
            function sendTaskOrderToServer(selector) {
                var order = [];
                $(selector).each(function(index,element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index+1
                    });
                });
                $.ajax({
                    type: "POST", 
                    dataType: "json", 
                    url: "{{ route('task.updateOrder') }}",
                    data: {
                    order:order,
                    _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        if (response.status == "success") {
                        console.log(response);
                        } else {
                        console.log(response);
                        }
                    }
                });
            }
        } );
    </script>
  </body>
</html>