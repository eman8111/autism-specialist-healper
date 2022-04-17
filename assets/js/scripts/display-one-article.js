let allArticles = [];

(async function(){
  var apiResponse = await fetch("https://moamen236.github.io/api/graduation_project/articles.json");
  allArticles = await apiResponse.json();
  allArticles = allArticles.articles;
  displayArticle();
})()
function displayArticle(){
    var articaleUrl = new URL(document.URL);
    var searchParams  = new URLSearchParams(articaleUrl.search); 
    for(var i of searchParams ) {
      var articaleID = i[1];
    }
  
    let article = allArticles.filter((oneArticle)=> oneArticle.id == articaleID)
    var showArticle = ``;
    showArticle +=`
      <div class="col-lg-8">
        <div class="card mt-4" style="min-height: 560px;">
            <img src="${article[0].imageUrl}" class="card-img-top" alt="...">
            <div class="card-body position-relative">
                <h1 class="card-title dark-title">${article[0].title}</h1>
                <div class="info">${article[0].content}</div>
            </div>
        </div>
      </div>
      `;
    document.getElementById('articaleContent').innerHTML = showArticle
}