function queryParams() {
     return new URLSearchParams(window.location.search);
}

function Confirmation(alert, action, method = "POST") {
     const confirmation = document.getElementById("confirmation");
     confirmation.classList.remove('hidden')
     confirmation.classList.remove('flex')
     confirmation.classList.add('flex')
     confirmation.querySelector(".message").innerHTML = alert
     confirmation.querySelector("form").setAttribute("action", action)
     confirmation
          .querySelector("form")
          .querySelector('input[name="_method"]').value = method
     document.getElementById('btn-toogle-confirmation')?.click()
}
function Confirm(title) {
     Confirmation(title, '', '')
     return document.getElementById("confirmation")
}


document.querySelectorAll('[data-toggle="confirmation"]').forEach((e) => {
     e.addEventListener("click", function () {
          Confirmation(
               e.getAttribute("data-message"),
               e.getAttribute("data-action"),
               e.getAttribute("data-method") || "POST"
          );
     });
})

document.querySelectorAll('[data-toggle="form-crud-edit"]')?.forEach((e) => {
     e.addEventListener("click", function () {
          const formCrud = document.getElementById('form-crud')
          document.getElementById('form-crud-title').innerHTML = 'Edit Data'
          formCrud.setAttribute('action', e.getAttribute('data-action'))
          formCrud.querySelector('input[name="_method"]').value = "PATCH"
     });
})

const buttonCrudForm = document.querySelector('#btn-add-crud-form')
buttonCrudForm?.addEventListener('click', (e) => {
     const formCrud = document.getElementById('form-crud')
     document.getElementById('form-crud-title').innerHTML = 'Add New'
     formCrud.setAttribute('action', buttonCrudForm.getAttribute('data-action'))
     formCrud.querySelector('input[name="_method"]').value = "POST"
})

document.querySelectorAll('div[x-hidden-first]').forEach((e) => {
     setTimeout(() => {
          e.classList.remove('hidden')
          e.classList.add('flex')
     }, 500)
})

document
     .getElementById("checkall-table-list")
     ?.addEventListener("change", function () {
          document
               .querySelectorAll(".datatable .table-checkbox")
               .forEach((e) => {
                    if (this.checked) {
                         if (!e.checked) {
                              e.click()
                         }
                         e.closest('tr').classList.add('selected-line')
                    } else {
                         if (e.checked) {
                              e.click()
                         }
                         e.closest('tr').classList.remove('selected-line')
                    }
               });
     })

document
     .querySelectorAll(".datatable .table-checkbox")
     .forEach((e) => {
          e.addEventListener("click", function () {
               if (e.checked) {
                    e.closest('tr').classList.add('selected-line')
               } else {
                    e.closest('tr').classList.remove('selected-line')
               }
          });
     });
document.querySelectorAll(".do-triger-bulk-action").forEach((bulkAction) => {
     bulkAction?.addEventListener("click", function () {
          const name = bulkAction.getAttribute('data-name')
          const target = bulkAction.getAttribute('data-target')
          const dataTableForm = document.getElementById('form-data-table')
          dataTableForm.querySelector('#bulk_action_type').value = bulkAction.getAttribute('data-action')
          dataTableForm.setAttribute('target', target)
          const confirm = Confirm(
               `Are you sure you want to ${name} the selected data?`
          )
          const buttonYes = confirm.querySelector("button.btn-confirm-yes")
          buttonYes.setAttribute('type', 'button')
          buttonYes.addEventListener("click", (e) => {
               if (target == '_self') {
                    buttonYes.setAttribute('disabled', true)
               }
               dataTableForm.submit()
               e.preventDefault()
          });
     })
})

document.querySelectorAll('form').forEach((form) => {
     form.addEventListener('submit', () => {
          form.querySelectorAll('button[type="submit"]').forEach((button) => {
               button.setAttribute('disabled', true)
               setTimeout(() => {
                    button.removeAttribute('disabled')
               }, 3000)
          })
     })
})

const formPopupImport = document.getElementById('form-popup-import')
const inputFilePopupImport = formPopupImport?.querySelector('#file-upload-import')
const buttonClearFIleImport = formPopupImport?.querySelector('.file-import-uploaded #import-clear-file')
formPopupImport?.querySelector('#btn-import-choose-file').addEventListener('click', () => {
     inputFilePopupImport.click()
})
inputFilePopupImport?.addEventListener('change', (e) => {
     const files = e.target.files;
     const emptyData = formPopupImport?.querySelector('.empty-data')
     const fileImportUploaded = formPopupImport?.querySelector('.file-import-uploaded')
     if (files) {
          const fileName = files[0].name;
          emptyData.classList.add('hidden')
          fileImportUploaded.classList.remove('hidden')
          fileImportUploaded.querySelector('#import-filename').innerHTML = fileName
          formPopupImport.querySelector('button[type="submit"]').removeAttribute('disabled')
     } else {
          emptyData.classList.remove('hidden')
          fileImportUploaded.classList.add('hidden')
          fileImportUploaded.querySelector('#import-filename').innerHTML = ''
          formPopupImport.querySelector('button[type="submit"]').setAttribute('disabled', true)
     }
})
buttonClearFIleImport?.addEventListener('click', () => {
     const emptyData = formPopupImport?.querySelector('.empty-data')
     const fileImportUploaded = formPopupImport?.querySelector('.file-import-uploaded')
     emptyData.classList.remove('hidden')
     fileImportUploaded.classList.add('hidden')
     fileImportUploaded.querySelector('#import-filename').innerHTML = ''
     inputFilePopupImport.value = ''
     formPopupImport.querySelector('button[type="submit"]').setAttribute('disabled', true)
})

document.querySelector('#input-limit-datatable')?.addEventListener('change', function () {
     const value = this.value
     const newUrl = new URL(window.location.href);
     newUrl.searchParams.set('limit', value);

     window.location.href = newUrl.href
})