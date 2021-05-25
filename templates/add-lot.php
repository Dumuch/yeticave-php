<form class="form form--add-lot container " action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Добавление лота</h2>
  <div class="form__container-two">

    <div class="form__item <?= isset($errors['lot-name']) ? 'form__item--invalid' : '' ?>"> <!-- form__item--invalid -->
      <label for="lot-name">Наименование</label>
      <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$required_fields['lot-name'];?>" >
      <span class="form__error">Введите наименование лота</span>
    </div>
    <div class="form__item <?= isset($errors['category-lot']) ? 'form__item--invalid' : '' ?>">
      <label for="category">Категория</label>
      <select id="category" name="category-lot">
        <option> <?= isset($required_fields['category-lot']) ? $required_fields['category-lot'] : 'Выберите категорию' ?>  </option>
        <?php foreach ($category as $key => $value): ?>
            <option><?=$value;?></option>
        <?php endforeach; ?>
      </select>
      <span class="form__error">Выберите категорию</span>

    </div>
  </div>

  <div class="form__item <?= isset($errors['message']) ? 'form__item--invalid' : '' ?> form__item--wide">
    <label for="message">Описание</label>
    <textarea id="message" name="message" placeholder="Напишите описание лота" ><?=$required_fields['message'];?></textarea>
    <span class="form__error">Напишите описание лота</span>
  </div>

  <div class="form__item form__item--file "> <!-- form__item--uploaded -->
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="/<?=$file_url;?>" width="113" height="113" alt="Изображение лота">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" name="preview-img" type="file" id="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <div class="form__container-three">

    <div class="form__item <?= isset($errors['lot-rate']) ? 'form__item--invalid' : '' ?> form__item--small">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$required_fields['lot-rate'];?>" >
      <span class="form__error">Введите начальную цену</span>
    </div>

    <div class="form__item <?= isset($errors['lot-step']) ? 'form__item--invalid' : '' ?> form__item--small">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$required_fields['lot-step'];?>" >
      <span class="form__error">Введите шаг ставки</span>
    </div>

    <div class="form__item <?= isset($errors['lot-date']) ? 'form__item--invalid' : '' ?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$required_fields['lot-date'];?>" >
      <span class="form__error">Введите дату завершения торгов</span>
    </div>

  </div>
  <span class="form__error form__error--bottom ">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>
