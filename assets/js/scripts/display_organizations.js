// API For Orgnization
let allOrgnizations = [];
(async function(){
  let apiResponse = await fetch("https://moamen236.github.io/api/graduation_project/organizations.json");
  allOrgnizations = await apiResponse.json();
  allOrgnizations = allOrgnizations.organizations;
  displayOrgnizations();
})()
function displayOrgnizations(){
  var orgnizations = ``;
  for(var i=0; i < allOrgnizations.length;i++){
    orgnizations +=`
    <div class="col-lg-4 mt-4">
        <div class="org rounded p-4 text-center shadow bg-white position-relative" style="min-height: 425px;">
            <img src="${allOrgnizations[i].logoUrl}" alt="" class="img-fluid
                mb-4 rounded">
            <a href="${allOrgnizations[i].url}" target="_blank"><h3 class="dark-title ">${allOrgnizations[i].name}</h3></a> 
            <p>${allOrgnizations[i].discription}</p>
            <div class="row text-start info">
                <div class="col-lg-12 mb-2">
                    <div class="row">
                        <div class="col-lg-1">
                            <div class="icon">
                                <i class=" fas fa-map-marker-alt red fa-lg"></i>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <p class="ms-1 d-inline">${allOrgnizations[i].address}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-1">
                            <div class="icon"></div>
                            <i class="fas fa-phone-alt red"></i>
                        </div>
                        <div class="col-lg-10">
                            <p class="ms-1 d-inline">${allOrgnizations[i].phone}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;
  }
  document.getElementById('orgs').innerHTML = orgnizations;
}