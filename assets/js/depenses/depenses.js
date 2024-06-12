function generateTableHead(table, data) {
  let thead = table.createTHead();
  let row = thead.insertRow();
  for (let key of data) {
    let th = document.createElement("th");
    let text = document.createTextNode(key);
    th.appendChild(text);
    row.appendChild(th);
  }
}
function generateTable(table, data) {
  for (let element of data) {
    let row = table.insertRow();
    for (key in element) {
      let cell = row.insertCell();
      let text = document.createTextNode(element[key]);
      cell.appendChild(text);
    }
  }
}
const monthNames = [
  'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout',
  'Septembere', 'Octobre', 'Novembre', 'Decembre'
];
 
function getMonthNames(){
  return monthNames;
}
// VARIABLES
const date_actuelle = new Date();
var annee_actuelle = date_actuelle.getFullYear();
var mois_actuelle = date_actuelle.getMonth();
// Changer de saison
function change_saison_actuelle(direction){
  mois_actuelle += direction;
  if (mois_actuelle > 11 || mois_actuelle < 0){
      annee_actuelle += (Math.abs(direction) / direction);
      if(mois_actuelle < 0){
          mois_actuelle = 12 + mois_actuelle;
      }
      mois_actuelle = Math.abs(mois_actuelle)  % 12
  } 
};