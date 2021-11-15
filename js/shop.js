// $(document).ready(function() {
    $( document ).ready(function() {


    let icon = document.querySelectorAll('ion-icon');
    
    // keep the heart red color if like = 1
    icon.forEach(function(icons) {

        if(icons.getAttribute('data-heartid')  > 0){
            icons.classList.toggle("active");

        }

    });

    //onclick like or unlike submit  to database
    icon.forEach(function(el) {
        el.onclick = function(){
            if($(this).data('heartid') > 0){
                like = 0;
            }else{
                like = 1;
            }

        el.classList.toggle('active');

            var request= $.ajax({url: "Controllers/update.php",
                
                type: "post",
                data: {
                product_id:$(this).data('postid'),
                user_id:$(this).data('user'),
                cart_id:$(this).data('cartid'),
                number:$(this).data('number'),
                likes:like,
            },
        });
        
        
        // request.done(function(msg) {
        //     alert ( "Response: " + msg );
        //     });
            
        //     request.fail(function(jqXHR, textStatus) {
        //     alert( "Request failed: " + textStatus );
        //     });
        };
    });


   
    
    
    

    var number = 1;
    // when add to cart is clicked
    $(".w-icon").click(function(){
        // alert("The paragraph was clicked.");
        $(this).css("background-color", "red");
    
        var request= $.ajax({url: "Controllers/update.php",
            
                type: "post",
                data: {product_id:$(this).data('postid'),
                user_id:$(this).data('user'),
                cart_id:$(this).data('cartid'),
                number:number,
                like:$(this).data('heartid'),

            },
        });
            request.done(function(msg) {
                alert ( "Response: " + msg );
            });
            
            request.fail(function(jqXHR, textStatus) {
                alert( "Request failed: " + textStatus );
            });
            // console.log($(this).data('postid'),$(this).data('user') );
        
            });

    });