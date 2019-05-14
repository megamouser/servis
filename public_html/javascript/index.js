$(function () {
  grecaptcha.ready(function() {
    grecaptcha.execute('6LeL0ooUAAAAAB1Q0p1fPZi9A7zmR1TfkuaXLO8B', {action: 'action_name'}).then(function(token) {
      let captchaInputs = document.querySelectorAll("#g-recaptcha-response")
      for (let captchaInput of captchaInputs) {
          captchaInput.value = token
      }
    });
  });


  class ModalWindow {
    constructor(modalElem,  closeElem) {
      this.modalElem = modalElem
      this.closeElem = closeElem
    }

    open() {
      this.modalElem.css('display', 'block')
      $('html').on('click', (event) => {
        if(event.target == this.modalElem[0] || event.target == this.closeElem[0]) {
          this.close()
        }
      })
    }

    close() {
      this.modalElem.css('display', 'none')      
    }
  }

  let scrollElems = $("#btn, #scrollme")
  let forms = $("form")
  successWindow = new ModalWindow($("#popupOne"), $("#closeOne"))
  orderWindow = new ModalWindow($("#popupTwo"), $("#closeTwo"))
  
  let validateSettings = {
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
        email: true
      },
      tel: {
        required: true,
      },
    },

    messages: {
      name: {
        required: "имя не указано",
      },
      email: {
        required: "email не указан",
        email: "некорректный email"
      },
      tel: {
        required: "телефон не указан",
      },

    },

    submitHandler: function (form) {
      let data = $(form).serialize()
      let formId = $(form).attr("id")
      let reqMethod = $(form).attr("method")
      console.log(reqMethod)
      console.log(formId)
      yaCounter52254511.reachGoal(formId)
      orderWindow.close()
      successWindow.open()
      $(form)[0].reset()
      $.ajax({
        type: "post",
        url: "posting",
        data: data,
        success: function (data) {
          console.log(data)
        }
      })
    }
    
  }

  function scroll(to) {
    let top = $(to).offset().top
    $("body, html").animate({ scrollTop: top }, 1500)
  }

  function validateForms(forms, settings) {
    for (form of forms) {
      $(form).validate(settings)
    }
  }

  $(scrollElems).click(function (e) {
    scroll('#formfield')
  })


  $('.order').on('click', function() {
    orderWindow.open()
  })
  
  validateForms(forms, validateSettings)
})
