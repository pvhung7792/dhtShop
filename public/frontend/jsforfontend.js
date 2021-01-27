
	$("#PRODUCT .MEMORY:first").removeClass('btn-outline-secondary').addClass('btn-secondary');

                        function clickShowDetailEveryWhere(a,b){ 
                          console.log(a);
                           console.log(b);
                           let clickMemory="#DETAIL"+b;

                           let nameRam = "RAM"+a;
                           let nameram = "ram"+a;
                           let nameMemory ="MEMORY"+a;
                           let namememory ="memory"+a;
                           let nameCPU ="CPU"+a;
                           let namePrice ="PRICE"+a;
                           let nameSale_price ="SALE_PRICE"+a;
                           let inputBy="BY_ID"+a;
                           let inputAddCart="ADDCART_ID"+a;

                           let attrProDetailId="IDPRODUCT_DETAIL"+b;
                           let attrRAM="RAM"+b;
                           let attrMEMORY="MEMORY"+b;
                           let attrCPU="CPU"+b;
                           let attrPRICE="PRICE"+b;
                           let attrSALE_PRICE="SALE_PRICE"+b;

                           let RAM=$(clickMemory).attr(attrRAM);
                           let MEMORY = $(clickMemory).attr(attrMEMORY);
                           let CPU = $(clickMemory).attr(attrCPU);
                           let PRICE = $(clickMemory).attr(attrPRICE);
                           let SALE_PRICE = $(clickMemory).attr(attrSALE_PRICE);
                           let IDPRODUCT_DETAIL = $(clickMemory).attr(attrProDetailId);

                           console.log(MEMORY);
                           console.log(RAM);
                           console.log(CPU);
                           console.log(PRICE);
                           console.log(SALE_PRICE);
                           console.log(nameMemory);
                           console.log(IDPRODUCT_DETAIL);
                           console.log(document.getElementById(inputBy).href);
                           console.log(document.getElementById(inputAddCart).href);
                          
                           		$('.MEMORY').addClass('btn-outline-secondary').removeClass('btn-secondary');
                           		$(clickMemory).removeClass('btn-outline-secondary').addClass('btn-secondary');
                           		$(nameRam).addClass('text-danger');
                           		$(nameMemory).addClass('text-danger');
                           		
							console.log(document.getElementById(nameMemory).innerHTML);
 
                           		document.getElementById(nameRam).innerHTML = RAM;
                           		document.getElementById(nameMemory).innerHTML = MEMORY;
                           		document.getElementById(nameram).innerHTML = RAM;
                           		document.getElementById(namememory).innerHTML = MEMORY;
                           		document.getElementById(nameCPU).innerHTML = CPU;
                           		document.getElementById(namePrice).innerHTML = PRICE;
                           		document.getElementById(nameSale_price).innerHTML = SALE_PRICE;
                           		document.getElementById(inputBy).href = location.href + "gio-hang/"+b;
                           		document.getElementById(inputAddCart).href = location.href + "them-gio-hang/"+b;
                        };



