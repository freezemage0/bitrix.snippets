### Отключение автоматических комментариев, генерируемых при изменении состояния сущности ###

Файлы Диска, которые были прикреплены к какой-либо сущности, по умолчанию автоматически добавляют комментарии об изменении своего состояния.
Целью данного сниппета является показать способ изменения поведения по умолчанию.

Реализация выполнена с помощью получения прикрепленного к сущности объекта с помощью `AttachedObject::getById()`.
У объектов класса `AttachedObject` есть метод `disableAutoComment`, позволяющий отключить нежелательное поведение.