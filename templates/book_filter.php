<div class="book-filter">
  <div class="row">
    <div class="card purple lighten-5">
      <div class="card-content text-darken-2">
        <form method="get">
          <span class="card-title">Фильтры книг</span>

          <br>

          <details>
            <summary>
              <span class="blue-text text-darken-2">По названиям книг</span>
            </summary>
            <div class="form-group-titles card-panel">
              <!-- <label for='book-title1'>Книга 1</label> -->
              <input type="text" id='book-title1' name='book_titles[]' placeholder="Книга 1">
            </div>
            <p>
              <button type="button" id="add-book-title">Добавить книгу</button>
              <button type="button" id="delete-book-title">Удалить книгу</button>
            </p>
          </details>

          <br>

          <details>
            <summary>
              <span class="blue-text text-darken-2">По издательствам</span>
            </summary>
            <div class="form-group-publishing-houses card-panel">
              <input type="text" id='publishing-house1' name='publishing_houses[]' placeholder="Издательство 1">
            </div>
            <p>
              <button type="button" id="add-publishing-house">Добавить издательство</button>
              <button type="button" id="delete-publishing-house">Удалить издательство</button>
            </p>
          </details>

          <br>

          <details>
            <summary>
              <span class="blue-text text-darken-2">По дате издания</span>
            </summary>
            <div class="form-group-publication_years card-panel">
              <label for="publication-year-min">Мин. дата издания</label>
              <input type="date" id='publication-year-min' name='publication_year_min'>
              <label for="publication-year-max">Макс. дата издания</label>
              <input type="date" id='publication-year-max' name='publication_year_max'>
            </div>
          </details>

          <br>

          <details>
            <summary>
              <span class="blue-text text-darken-2">По авторам</span>
            </summary>
            <div class="form-group-authors card-panel">
              <input type="text" id='author1' name='authors[]' placeholder="Автор 1">
            </div>
            <p>
              <button type="button" id="add-author">Добавить автора</button>
              <button type="button" id="delete-author">Удалить автора</button>
            </p>
          </details>

          <br>

          <details>
            <summary>
              <span class="blue-text text-darken-2">По жанрам</span>
            </summary>
            <div class="form-group-genres card-panel">
              <input type="text" id='genre1' name='genres[]' placeholder="Жанр 1">
            </div>
            <p>
              <button type="button" id="add-genre">Добавить жанр</button>
              <button type="button" id="delete-genre">Удалить жанр</button>
            </p>
          </details>

          <br>

          <button class="btn btn-small" type="submit">Применить фильтры</button>

        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function add(btnSelector, btnDelSelector, divSelector, inputType, inputSelector, labelText, inputName) {
    let i = 1
    const titlesDiv = document.querySelector(divSelector)
    if (!titlesDiv) {
      return
    }

    const titlesButton = document.querySelector(btnSelector)
    const delTitlesBtn = document.querySelector(btnDelSelector)

    if (titlesButton && delTitlesBtn) {
      console.log(titlesButton)
      titlesButton.onclick = function() {
        // const newLabel = document.createElement('label')
        // const id = inputSelector + (++i).toString()
        // newLabel.setAttribute('for', id)
        // const newLabelText = document.createTextNode(labelText + i.toString())
        // newLabel.appendChild(newLabelText)
        // titlesDiv.appendChild(newLabel)

        const newInput = document.createElement('input')
        const id = inputSelector + (++i).toString()
        newInput.setAttribute('type', inputType)
        newInput.setAttribute('id', id)
        newInput.setAttribute('name', inputName)
        newInput.setAttribute('placeholder', labelText + i.toString())
        titlesDiv.appendChild(newInput)
      }
      delTitlesBtn.onclick = function() {
        if (!i) {
          return
        }

        const id = inputSelector + i.toString()
        const input = document.getElementById(id)
        titlesDiv.removeChild(input)
        i--
      }
    }
  }

  add('#add-book-title', '#delete-book-title', '.form-group-titles', 'text', 'book-title', 'Книга ', 'book_titles[]')
  add('#add-publishing-house', '#delete-publishing-house', '.form-group-publishing-houses', 'text', 'publishing-house', 'Издательство ', 'publishing_houses[]')
  add('#add-author', '#delete-author', '.form-group-authors', 'text', 'author', 'Автор ', 'authors[]')
  add('#add-genre', '#delete-genre', '.form-group-genres', 'text', 'genre', 'Жанр ', 'genres[]')

  
</script>