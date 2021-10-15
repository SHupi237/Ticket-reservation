document.addEventListener('DOMContentLoaded', (event) => {
    var stringReservedSeats = '';
    for (var j = 0; j <= 299; j++){
        var seats = document.getElementById('seat' + j);
        seats.onclick = function(){ 
            document.onclick = function(event) {
                if (event === undefined) event= window.event;
                var target = 'target' in event? event.target : event.srcElement;
                var i = 0;
            };
            this.classList.remove("seatRow");
            this.classList.toggle("choosedSeat")
            };
    }
    var submitButton = document.getElementById('submitButton');
    submitButton.onclick = function() {
        var getId = document.getElementById("movieId")
        var choosedSeats = document.querySelectorAll('.choosedSeat');
        for (var k = 0; k < choosedSeats.length; k++){
            stringReservedSeats = stringReservedSeats + choosedSeats[k].innerHTML + '|'
            console.log(stringReservedSeats)
        }
        $.ajax({
            type: 'get',
            url: 'http://localhost/Ticket-reservation/insertTicket.php?seats='+stringReservedSeats+'&movieid='+getId.value,
            success: function( data ) {
            }
        });
        console.log('http://localhost/Ticket-reservation/insertTicket.php?seats='+stringReservedSeats+'&movieid='+getId.value);
        setTimeout(function(){window.location.replace("moviesList.php")}, 3000);
    }
 });
