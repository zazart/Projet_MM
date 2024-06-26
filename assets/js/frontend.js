function creeXHR() {
    var xhr;
    try {
      xhr = new ActiveXObject('Msxml2.XMLHTTP');
    } catch (e) {
      try {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
      } catch (e2) {
        try {
          xhr = new XMLHttpRequest();
        } catch (e3) {
          xhr = false;
        }
      }
    }
    return xhr;
  }
function viewTableData(tableId,titles,dataArray,editUrl,removeUrl , actions_  = true) {
    if ($.fn.DataTable.isDataTable(`#${tableId}`)) {
      $(`#${tableId}`).DataTable().destroy();
    }

    if(actions_){
      titles.push({
        title: 'Actions',
        render: function(data, type, row, meta) {
          var editImgSrc = `${base_url}/assets/img/modifier.png`;
          var deleteImgSrc = `${base_url}/assets/img/corbeille.png`;
          return '<img class="img-modifier" style="margin-right:30px;cursor:pointer;" src="' + editImgSrc + '" data-id="' + row[0] + '" alt="Modifier">' +
          '<img class="img-supprimer" style="margin-right:30px;cursor:pointer;" src="' + deleteImgSrc + '" data-id="' + row[0] + '" alt="Supprimer">';
        }
      });
    }
    var table = $(`#${tableId}`).DataTable({
      data: dataArray,
      columns: titles
    });
    if(actions_){

      // Événement click sur les images Modifier
      $(`#${tableId} tbody`).on('click','.img-modifier', function() {
        var id = $(this).data('id');
        window.location.href =
          `${base_url}/${editUrl}/${id}`;
      });

      // Événement click sur les images Supprimer
      $(`#${tableId} tbody`).on('click', '.img-supprimer', function() {
        var id = $(this).data('id');
        swal({
          title: 'Confirmation de la suppression',
          text: 'Voulez vous vraiment supprimer',
          icon: 'warning',
          buttons: true,
          dangerMode: true,
        }).then((isOkay) => {
          if (isOkay) {
            var xhrSupprimer = creeXHR();
            xhrSupprimer.open('POST',`${base_url}/${removeUrl}`,true);
            xhrSupprimer.setRequestHeader('X-Requested-With','XMLHttpRequest');
            xhrSupprimer.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhrSupprimer.onreadystatechange = function() {
              console.log(xhrSupprimer);
              if (xhrSupprimer.readyState == 4 && xhrSupprimer.status == 200) {
                var response = JSON.parse(xhrSupprimer.responseText);
                if (response.success) {
                  swal({
                    title: 'Succès',
                    text: 'Element supprimé avec succès.',
                    icon: 'success',
                    buttons: 'OK'
                  }).then((isOkay) => {
                    if (isOkay) {
                      window.location
                        .reload();
                    }
                  });
                }
              }
              if (xhrSupprimer.status == 500) {
                swal({
                  title: 'Erreur',
                  text: 'Cette depense ne peut pas etre supprimer',
                  icon: 'error',
                  buttons: 'OK'
                }).then((isOkay) => {
                  if (isOkay) {
                    window.location
                      .reload(); // Actualise la page après la confirmation
                  }
                });
              }
            };
            xhrSupprimer.send('id=' + encodeURIComponent(
              id
            )); // Envoie l'ID du client en tant que paramètre POST
          }
        });
      });
    }
  }