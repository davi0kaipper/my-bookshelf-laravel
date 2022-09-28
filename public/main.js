// [01] REMOVE SELECIONADOS
var removeSelected = document.getElementById('remove_selected');

removeSelected.addEventListener('click', function () {
  var shouldRemove = confirm('Você realmente gostaria de apagar todos os livros selecionados?');
  var removeForm = document.getElementById('remove_form');

  if (shouldRemove) {
    removeForm.submit();
  }
});

// [02] LÓGICA DOS CHECKBOXES

// 1. obtém todos os checkbox que permitem selecionar um livro com id específico
var checkboxes = document.querySelectorAll('.select_item');

// 2. itera sobre a lista de checkbox para adicionar um evento de click em cada um deles
for (var checkbox of checkboxes) {

  // 3. adiciona o evento de click no checkbox atual da iteração
  checkbox.addEventListener('click', function (e) {

    // 4. a função de callback passada no addEventListener receberá um objeto do tipo Event
    // pode-se obter, por exemplo, o elemento no qual o evento foi disparado utilizando e.target
    // console.log(e.target);

    // 5. cria lista de itens selecionados
    createSelectedList();
  })
}

function createSelectedList() {
  // 1. define um array que conterá os ids selecionados
  var selectedItems = [];

  // 2. obtém o campo que guarda os ids que serão removidos
  var selected = document.getElementById('selected');

  // 3. obtém todos os checkbox para filtrar o id dos selecionados
  var checkboxes = document.querySelectorAll('.select_item');

  // 4. itera sobre os checkbox e obtém os id dos checkbox selecionados
  checkboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      selectedItems.push(checkbox.value);
    }
  });

  // 5. guarda os ids selecionados
  selected.value = selectedItems.join(',');
}

// [03] CHECKBOX SELECIONAR TODOS

// 1. obtém a referência do botão que seleciona todos
var selectAll = document.getElementById('select_all');

// 2. adiciona um evento de clique no botão que seleciona todos
selectAll.addEventListener('click', function () {

  // 3. obtém todos os checkbox que permitem selecionar um livro com id específico
  var checkboxes = document.querySelectorAll('.select_item');

  // 4. itera sobre os checkbox e obtém os id dos checkbox selecionados
  checkboxes.forEach(function (checkbox) {
    checkbox.checked = selectAll.checked;
  });

  // 5. cria lista de itens selecionados
  createSelectedList();
});


