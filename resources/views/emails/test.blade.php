{{-- <style>
.test-email{
    width: 500px;
    margin: 0 auto;
    padding: 15px;
    text-align: center
}
</style> --}}
<div class="test-email" >
    <h2>Hi,  {{$name}} </h2> 
    
        <h3>Thank you for choosing MoonLight Cinema. Your transaction has been processed sucessfully.</h3>
        <p>Please show email order confirmation to collect your tickets from the Counter.</p>
        
        <br>
        <br>
        <div style="display: flex; flex-direction: column; align-items: center;" class="ticketContainer">
            <div style="background-color: wheat; color: darkslategray; border-radius: 12px;" class="ticket">
                <div style="font-size: 1.5rem; font-weight: 700; padding: 12px 16px 4px;" class="ticketTitle">MoonLight
                    Cinema
                </div>
                <hr style="width: 90%; border: 1px solid #efefef;">
                <div style="font-size: 1.1rem; font-weight: 500; padding: 4px 16px;" class="ticketDetail">
                    <div>Movie:{{$movie}}</div>
                    <div>Room:{{$room}}</div>
                    <div>Seat: {{$seat}}</div>
                    <div>Time: {{$time}}</div>
                    <div>Date: {{$day}}</div>
                    <div>TotalPrice: {{$totalPrice}} </div>
                   
                </div>
    <table>
    
    </table>
    </div>