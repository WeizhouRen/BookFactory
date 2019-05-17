        function judgeauthor(x, check_val){
            var y = [];
            for (var i = 0; i < check_val.length; i++) {
                for (var j = 0; j < x.length; j++) {
                    if (check_val[i] == x[j].getElementsByTagName("AUTHOR")[0].childNodes[0].nodeValue) {
                        y.push(x[j]);
                    };
                };
                
            };
                
            return y;
        }
        function judgetype(x, type){
            var y = [];
            for (var i = 0; i < x.length; i++) {
                if ((type == x[i].getElementsByTagName("GENRE")[0].childNodes[0].nodeValue) || (type == "")) {
                    y.push(x[i]);
                };
            };
            return y;
        }


        function showproduct(x, type, page){
           // body...
            
            text = "";  
            number = 6;
            var z =[];
            var currentShowNumber = 0;
            if (document.getElementById("sort").value == "Price: low-high")
                x = sort(x, 1);
            else
                x = sort(x, 0);

            x = judgetype(x, type);

            var obj = document.getElementsByName("test");
            var check_val = [];
            for(var i = 0; i< obj.length; i++){
                if(obj[i].checked)
                    check_val.push(obj[i].value);
            }
            if (check_val.length > 0) {
                x = judgeauthor(x , check_val);
            }

            for (i = (page - 1) * number; i < page * number; i++) {
                try{
                xname = x[i].getElementsByTagName("NAME")[0].childNodes[0].nodeValue;
                xprice = x[i].getElementsByTagName("PRICE")[0].childNodes[0].nodeValue;
                ximage = x[i].getElementsByTagName("IMAGE")[0].childNodes[0].nodeValue;
                producttype = x[i].getElementsByTagName("GENRE")[0].childNodes[0].nodeValue;
                xurl = "bookdetail.html?id=" + x[i].getElementsByTagName("NAME")[0].childNodes[0].nodeValue.replace(/ /g,"+");

                
                    text += `<div class="col-md-4 col-sm-6">
                                    <div class="product">
                                        <div class="flip-container">
                                                <div class="flipper" style="margin-top:80px">
                                                    <div class="front">
                                                        <a href=${xurl}>
                                                            <img src=${ximage} alt=${xname} style="width:252px; height:252px;" class="img-responsive">
                                                        </a>
                                                    </div>
                                                    <div class="back">
                                                        <a href=${xurl}>
                                                            <img src=${ximage} alt=${xname} style="width:252px; height:252px;" class="img-responsive">
                                                        </a>
                                                    </div>
                                                </div>
                                        </div>
                                        <a href="detail.html" class="invisible">
                                            <img src="img/product2.jpg" alt="" class="img-responsive">
                                        </a>
                                        <div class="text">
                                            <h3><a href="detail.html">${xname}</a></h3>
                                            <p class="price">$${xprice}</p>
                                            <p class="buttons">
                                                <a href=${xurl} class="btn btn-default">View detail</a>
                                                <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </p>

                                        </div>
                                        <!-- /.text -->
                                    </div>
                                        <!-- /.product -->
                            </div>`
                   currentShowNumber++;
               }catch(exception){
                    break;
               }

            }
                pageText = `<ul class="pagination">`;
                for (i = 0; i <  Math.ceil(x.length / number); i++) {
                    pageText += `<li id = page${i + 1}>
                                    <a href="javascript:void(0)" onclick="showproduct(x, producttype, ${i + 1})">
                                    ${i + 1}
                                    </a>
                                </li>`
                };
                pageText +=`</ul>`;
                document.getElementById("booklist1").innerHTML = text;
                document.getElementById("currentShowNumber").innerHTML = currentShowNumber;
                document.getElementsByName("totalNumber")[0].innerHTML = x.length;
                document.getElementById("pagesNumber").innerHTML = pageText;
                document.getElementById("page" + page).className = "active";     

                return type;
            
        }

        function sort(x, b){
            var rows = [];
            var t, i, j;
            if (b == 1) {
                for (i = 1; i < x.length; i ++) {
                    for (j = i; j > 0; j --) {
                        if (Number(x[j].getElementsByTagName("PRICE")[0].childNodes[0].nodeValue) < Number(x[j-1].getElementsByTagName("PRICE")[0].childNodes[0].nodeValue) )
                        {
                            t = x[j-1].innerHTML;
                            x[j-1].innerHTML = x[j].innerHTML;
                            x[j].innerHTML = t;
                        };
                    };
                
                };
            }
            else{
                for (i = 1; i < x.length; i ++) {
                    for (j = i; j > 0; j --) {
                        if (Number(x[j].getElementsByTagName("PRICE")[0].childNodes[0].nodeValue) > Number(x[j-1].getElementsByTagName("PRICE")[0].childNodes[0].nodeValue) )
                        {
                            t = x[j-1].innerHTML;
                            x[j-1].innerHTML = x[j].innerHTML;
                            x[j].innerHTML = t;
                        };
                    };
                
                };
            }
            return x;        
        }

        function GetQueryString(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
            var r = window.location.search.substr(1).match(reg);
            if (r!=null) return (r[2]); return null;
        };
        
        function showdetail(x){
            text = "";
            var name = GetQueryString("id").replace(/\+/g," ");
            for (var i = 0; i < x.length; i++) {

                if (name == x[i].getElementsByTagName("NAME")[0].childNodes[0].nodeValue) {
                    xprice = x[i].getElementsByTagName("PRICE")[0].childNodes[0].nodeValue;
                    ximage1 = x[i].getElementsByTagName("IMAGE1")[0].childNodes[0].nodeValue;
                    xdetail = x[i].getElementsByTagName("DETAIL")[0].childNodes[0].nodeValue;
                    xmaterial = x[i].getElementsByTagName("MATERIAL")[0].childNodes[0].nodeValue;
                    xcare = x[i].getElementsByTagName("CARE")[0].childNodes[0].nodeValue;
                    xsize = x[i].getElementsByTagName("SIZE")[0].childNodes[0].nodeValue;
                    xfit = x[i].getElementsByTagName("FIT")[0].childNodes[0].nodeValue;
                    xstatement = x[i].getElementsByTagName("STATEMENT")[0].childNodes[0].nodeValue;
                    xgender = x[i].getElementsByTagName("GENDER")[0].childNodes[0].nodeValue;
                    break;

                };
                
            }
            text += `<div class="row" id="productMain">
                            <div class="col-sm-6">
                                <div id="mainImage">
                                    <img src=${ximage1} style="width:400px; height:375px;" alt="" class="img-responsive">
                                </div>

                                <div class="ribbon sale">
                                    <div class="theribbon">SALE</div>
                                    <div class="ribbon-background"></div>
                                </div>

                                <div class="ribbon new">
                                    <div class="theribbon">NEW</div>
                                    <div class="ribbon-background"></div>
                                </div>
                            
                            </div>
                            <div class="col-sm-6">
                                <div class="box">
                                    <h1 class="text-center">${name}</h1>
                                    <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, material & care and sizing</a>
                                    </p>
                                    <p class="price">$${xprice}</p>

                                    <p class="text-center buttons">
                                        <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> 
                                    <!--
                                        <a href="basket.html" class="btn btn-default"><i class="fa fa-heart"></i> Add to wishlist</a>
                                    -->
                                    </p>


                                </div>
                            </div>

                    </div>


                    <div class="box" id="details">
                            <p>
                                <h4>Product details</h4>
                                <p>${xdetail}</p>
                                <h4>Material & care</h4>
                                <ul>
                                    <li>${xmaterial}</li>
                                    <li>${xcare}</li>
                                </ul>
                                <h4>Size & Fit</h4>
                                <ul>
                                    <li>${xsize}</li>
                                    <li>${xfit}</li>
                                </ul>

                                <blockquote>
                                    <p><em>${xstatement}</em>
                                    </p>
                                </blockquote>

                                <hr>
                                <div class="social">
                                    <h4>Show it to your friends</h4>
                                    <p>
                                        <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                        <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                                        <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                                        <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                                    </p>
                                </div>
                    </div>`
                    document.getElementById("showproduct2").innerHTML = text;
                    document.getElementById("showname").innerHTML = name;
                    document.getElementById("showgender").innerHTML = xgender;

                    return xgender;

        }
        






$(document).ready(function() {
    

    /*** --------- BOOK LIST --------- ***/
    //book list page change pages
    $(".list-table").fadeOut();
    $("#page-1").fadeIn();
    $(".page-no").click(function(){
        if($(this).text() == "2") {
            $(".list-table").hide();
            $("#page-2").fadeIn();
        } else if ($(this).text() == "3") {
            $(".list-table").hide();
            $("#page-3").fadeIn();
        } else if ($(this).text() == "4") {
            $(".list-table").hide();
            $("#page-4").fadeIn();
        } else if ($(this).text() == "5") {
            $(".list-table").hide();
            $("#page-5").fadeIn();
        } else if ($(this).text() == "1") {
            $(".list-table").hide();
            $("#page-1").fadeIn();
        }
    });

    /*** --------- HOMEPAGE --------- ***/
    // homepage sliding
    var count = 0;
    imageSliding();

    function imageSliding() {
        var i;
        var x = document.getElementsByClassName("slide");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none"; 
        }
        count++;
        if (count > x.length) {count = 1} 
        x[count-1].style.display = "block"; 
        setTimeout(imageSliding, 2500); 
    }

    //login
    var loginPage = document.getElementById('login_panel');
        window.onclick = function(event) {
        if (event.target == loginPage) {
            loginPage.style.display = "none";
        }
    }
    /*** --------- BOOK DETAIL --------- ***/
    
});