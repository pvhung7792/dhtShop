//lọc theo hãng sản phẩm

$(document).ready(function() {
	let ValueBrand=[];
	
	$('input.BRANDid').click(function(){
		$('#brandall').prop('checked',false);
		$("#FormSLDK").submit();
		
	});
	if(!$('#brandall').attr("checked")){
		$('input#brandall').click(function(){
			$('#brandall').prop('checked',true);
			$('input.BRANDid').prop('checked',false);
			$("#FormSLDK").submit();
		})
	}else{
		$('input#brandall').click(function(){
			$('#brandall').prop('checked',true);
		})
		
	}
});



// lọc theo mức giá
$(document).ready(function() {
	$('input.PriceOne').click(function(){
					$('.PriceAll').prop('checked',false);
					$("#FormSLDK").submit();
					
				});
				if(!$('.PriceAll').attr("checked")){
					$('.PriceAll').click(function(){
						$('.PriceAll').prop('checked',true);
						$('input.PriceOne').prop('checked',false);
						$("#FormSLDK").submit();
					})
				}else{
					$('.PriceAll').click(function(){
						$('.PriceAll').prop('checked',true);
					})
					
				}
});



// sắp xếp sản phẩm
$(document).ready(function() {
	console.log($("select#THSLDK").find(":selected").val());
									$(function(){
										$('#THSLDK').change( function(){
											$("#FormSLDK").submit();
											console.log($("select .THSLDK").val());
										})
									})
});






//thay đổi nội dung trên chi tiết khi click
			

			function clickShowDetailEveryWhere(a,b){ 

		                          console.log(a,b);
		                           
		                           let classMEMORY = ".MEMORY"+a;
		                           let clickMemory="#DETAIL"+b;

		                           let nameRam = "#RAM"+a;
		                           let nameram = "#ram"+a;
		                           let nameMemory ="#MEMORY"+a;
		                           let namememory ="#memory"+a;
		                           let nameCPU ="#CPU"+a;
		                           let namePrice ="#PRICE"+a;
		                           let nameSale_price ="#SALE_PRICE"+a;
		                           let nameOldPrice="#OLDPRICE"+a;
		                           let inputId_Detail="#ID_DETAIL"+a;
		                           let HIDDENSALEPRICE =".HIDDENSALEPRICE"+a;

		                           let inputId_Color="ID_COLOR"+a;

		                           let attrDetailId="ID_DETAIL"+b;
		                           let attrRAM="RAM"+b;
		                           let attrMEMORY="MEMORY"+b;
		                           let attrCPU="CPU"+b;
		                           let attrPRICE="PRICE"+b;
		                           let attrSALE_PRICE="SALE_PRICE"+b;
		                           let attrOLDPRICE="OLDPRICE"+b;

		                           let RAM=$(clickMemory).attr(attrRAM);
		                           let MEMORY = $(clickMemory).attr(attrMEMORY);
		                           let CPU = $(clickMemory).attr(attrCPU);
		                           let PRICE = $(clickMemory).attr(attrPRICE);
		                           let SALE_PRICE = $(clickMemory).attr(attrSALE_PRICE);
		                           let OLDPRICE = $(clickMemory).attr(attrOLDPRICE);
		                           let ID_DETAIL = $(clickMemory).attr(attrDetailId);
		                           /*let ID_COLOR = $(clickMemory).attr(attrColorId);*/
		                          
		                          
		                           		$(classMEMORY).addClass('btn-outline-secondary').removeClass('btn-secondary');
		                           		$(clickMemory).removeClass('btn-outline-secondary').addClass('btn-secondary');
		                           		/*$(nameRam).addClass('text-danger');
		                           		$(nameMemory).addClass('text-danger');*/
		                           		
		                           		if(SALE_PRICE==0){
		                           			console.log(HIDDENSALEPRICE);
		                           			$(HIDDENSALEPRICE).prop("hidden",true);
		                           		}else{
		                           			$(HIDDENSALEPRICE).prop("hidden",false);
		                           		}

		                           		$(nameRam).text(RAM);
		                           		$(nameram).text(RAM);
		                           		$(nameMemory).text(MEMORY);
		                           		$(namememory).text(MEMORY);
		                           		$(nameCPU).text(CPU);
		                           		$(namePrice).text(PRICE);
		                           		$(nameSale_price).text(SALE_PRICE);
		                           		$(namePrice).text(PRICE);
		                           		$(nameOldPrice).text(OLDPRICE);
									
										$(inputId_Detail).val(ID_DETAIL);
		                           		console.log(nameram,nameRam,RAM);
		                           		

		                        };



//mở from nhập câu trả lời cho admin trên người dùng
let a= 0;
  function clickRep(a){ 
    console.log(a);
    let classclick = ".hien_form_traloi"+a;
    let classRep = ".form_traloi"+a;
    console.log(classclick);
    console.log(classRep);
    $(classclick).click(function(){
      $(classRep).show();
    });
  };


  //gợi ý tên cho tìm kiếm so sánh
  




// add và xóa wish list

 
