const pw = document.getElementById("pw");
const pw_button = document.getElementById("pw_button");

const img_container = document.getElementById("img_container");
const img_del = document.getElementById("img_del");

const main_img = document.getElementById("main_img");


/**
 * Funzione mostra/nascondi password
 */
if(pw_button != null)
pw_button.addEventListener("click", function () {
    if (pw.getAttribute("type") === "password") {
        pw.setAttribute("type", "text");
        pw_button.innerHTML = "nascondi";
      } else {
        pw.setAttribute("type", "password");        
        pw_button.innerHTML = "mostra";
      }
});




/**
 * Gestione upload immagini quando creo nuovo annuncio
 */

var images_nbr = 1;
function addimage(e){
  fileList = document.getElementById("img_inp"+images_nbr).files;
  if (fileList.length > 0) {
    document.getElementById("preview"+images_nbr).src = URL.createObjectURL(fileList[0]);
    if(images_nbr===1){
      img_del.classList.remove("hidden");
    }
    images_nbr++;
    if(images_nbr<11){
      img_container.insertAdjacentHTML('beforeend',
       '<label for="img_inp'+images_nbr+'" class="block rounded-lg border w-28 h-28 hover:cursor-pointer">'+
           '<input accept="image/*" type=\'file\' id="img_inp'+images_nbr+'" name="img_inp'+images_nbr+'" style="visibility: hidden; position: absolute;" />'+
           '<img id="preview'+images_nbr+'" src="/img/adv_images/addimage.png" alt="your image" class="w-full h-full object-cover rounded-lg"/>'+
       '</label>');
      document.getElementById("img_inp"+images_nbr).addEventListener("change", addimage);
    }
  }
}

if(document.getElementById("img_inp1") != null)
document.getElementById("img_inp1").addEventListener("change", addimage);

img_del.addEventListener("click", function () {
  img_del.classList.add("hidden");
  images_nbr = 1;
  img_container.innerHTML = 
    '<label for="img_inp'+images_nbr+'" class="block rounded-lg border w-28 h-28">'+
        '<input accept="image/*" type=\'file\' id="img_inp'+images_nbr+'" style="visibility: hidden; position: absolute;" />'+
        '<img id="preview'+images_nbr+'" src="/img/adv_images/addimage.png" alt="your image" class="w-full h-full object-cover rounded-lg"/>'+
    '</label>';
  document.getElementById("img_inp"+images_nbr).addEventListener("change", addimage);
});

function changeimg(e){
  main_img.setAttribute("src", e.srcElement.getAttribute("src"));
}