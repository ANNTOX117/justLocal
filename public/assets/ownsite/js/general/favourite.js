$(document).ready(function() {
    $(".section--businesses__content").css("display", "block"); 
    $("a.block__favorite").click(function(){
        $(this).parent().hide();
        if(this.attributes["data-type"].nodeValue==="company"){
            let spanElement = $("#total_companies span");
            let currentNumber = parseInt(spanElement.text());
            console.log(currentNumber);
        if (currentNumber > 0) {
            let newNumber = currentNumber - 1;
            spanElement.text(newNumber);
        }
        }else{
            let spanElement = $("#total_offers span");
            let currentNumber = parseInt(spanElement.text());
            if (currentNumber > 0) {
                let newNumber = currentNumber - 1;
                spanElement.text(newNumber);
            }
        }
    });
});
