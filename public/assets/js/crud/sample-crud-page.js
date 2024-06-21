document.querySelectorAll('[data-toggle="form-crud-separate"]').forEach((e) => {
     e.addEventListener("click", function () {
          const action = e.getAttribute('data-action')
          const formCrud = document.getElementById('form-crud')
          const newPairTotal = formCrud.querySelector("#total_pairs")
          const submitButton = formCrud.querySelector('[type="submit"]')
          const currentPairs = Number(e.getAttribute('data-pairs'))

          formCrud.setAttribute('action',action)
          formCrud.querySelector('#current_pairs').innerHTML = currentPairs
          submitButton.setAttribute('disabled',true)
          newPairTotal.setAttribute('max',currentPairs)

          newPairTotal.addEventListener('keyup',function(){
               const value = Number(this.value)
               if(value>currentPairs){
                    this.value = currentPairs
               }
               if(this.value){
                    const newBarcode = Number(currentPairs)/Number(this.value)
                    if(newBarcode % 1!=0){
                         formCrud.querySelector("#error_message").innerHTML = "The result is still left over"
                         submitButton.setAttribute('disabled',true)
                    }else{
                         formCrud.querySelector("#error_message").innerHTML = ""
                         submitButton.removeAttribute('disabled')
                    }

                    formCrud.querySelector("#new_barcode_result").innerHTML = newBarcode
               }else{
                    formCrud.querySelector("#error_message").innerHTML = ""
                    formCrud.querySelector("#new_barcode_result").innerHTML = "0"
                    submitButton.setAttribute('disabled',true)
               }
          })

          // 
     });
})