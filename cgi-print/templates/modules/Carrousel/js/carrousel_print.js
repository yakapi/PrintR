let carrousel_print = document.querySelectorAll('.carrousel_print')
for (var u = 0; u < carrousel_print.length; u++) {
  if (carrousel_print[u].hasChildNodes()) {
    let encard_image = carrousel_print[u].children
    for (var i = 1; i < encard_image.length; i++) {
      encard_image[i].style.right = "100%"
      encard_image[i].style.opacity = "0"
    }
    let nb = 0;
    let animation_carrousel = setInterval(()=>{
      if (nb == 1) {
        if (encard_image[0].style.right != "100%") {
          encard_image[0].style.right = "100%"
          encard_image[0].style.opacity = "0"
          encard_image[0].style.zIndex = "0"
        }
      }
      nb += 1
      if (nb < encard_image.length) {
        encard_image[nb].style.right = "0%"
        encard_image[nb].style.opacity = "1"
      }else {
        nb = 0
        encard_image[0].style.right = "0%"
        encard_image[0].style.opacity = "1"
        // encard_image[0].style.zIndex = "1000"
        for (var i = 1; i < encard_image.length; i++) {
          encard_image[i].style.right = "100%"
          encard_image[i].style.opacity = "0"
        }
      }
    },5000);

  }
}
