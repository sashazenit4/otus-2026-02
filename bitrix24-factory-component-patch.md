# Изменения в `local/components/otus/book.grid/class.php`

## 1. Добавить use

```php
use Otus\Grid\View\BookGridViewFactory;
use Otus\Grid\View\GridViewFactoryInterface;
```

## 2. Добавить свойство и метод фабрики внутрь класса `BookGrid`

```php
private ?GridViewFactoryInterface $gridViewFactory = null;

private function getGridViewFactory(): GridViewFactoryInterface
{
    if ($this->gridViewFactory === null) {
        $this->gridViewFactory = new BookGridViewFactory();
    }

    return $this->gridViewFactory;
}
```

## 3. Заменить получение headers/filter/rows в `prepareGridData()`

```php
private function prepareGridData(): void
{
    $viewFactory = $this->getGridViewFactory();
    $headerProvider = $viewFactory->createHeaderProvider();
    $filterProvider = $viewFactory->createFilterProvider();
    $rowFormatter = $viewFactory->createRowFormatter();

    $this->arResult['HEADERS'] = $headerProvider->getHeaders();
    $this->arResult['FILTER_ID'] = self::GRID_ID;

    $gridOptions = new GridOptions($this->arResult['FILTER_ID']);
    $this->arResult['USED_HEADERS'] = $gridOptions->getUsedColumns($this->arResult['HEADERS']);

    if (empty($this->arResult['USED_HEADERS'])) {
        $this->arResult['USED_HEADERS'] = array_column($this->arResult['HEADERS'], 'id');
    }

    $navParams = $gridOptions->getNavParams();

    $nav = new PageNavigation($this->arResult['FILTER_ID']);
    $nav->allowAllRecords(true)
        ->setPageSize($navParams['nPageSize'])
        ->initFromUri();

    $filterOption = new FilterOptions($this->arResult['FILTER_ID']);
    $filterData = $filterOption->getFilter([]);
    $filter = $filterProvider->prepareFilter($filterData);

    $sort = $gridOptions->getSorting([
        'sort' => ['ID' => 'DESC'],
        'vars' => ['by' => 'by', 'order' => 'order'],
    ]);

    $bookIdsQuery = BookTable::query()
        ->setSelect(['ID'])
        ->setFilter($filter)
        ->setLimit($nav->getLimit())
        ->setOffset($nav->getOffset())
        ->setOrder($sort['sort']);

    $countQuery = BookTable::query()
        ->setSelect(['ID'])
        ->setFilter($filter);

    $nav->setRecordCount($countQuery->queryCountTotal());

    $bookIds = array_column($bookIdsQuery->exec()->fetchAll() ?? [], 'ID');

    if (!empty($bookIds)) {
        $books = BookTable::getList([
            'filter' => ['ID' => $bookIds] + $filter,
            'select' => [
                'ID',
                'TITLE',
                'YEAR',
                'PAGES',
                'PUBLISH_DATE',
                'AUTHOR_ID' => 'AUTHORS.ID',
                'AUTHOR_FIRST_NAME' => 'AUTHORS.FIRST_NAME',
                'AUTHOR_LAST_NAME' => 'AUTHORS.LAST_NAME',
                'AUTHOR_SECOND_NAME' => 'AUTHORS.SECOND_NAME',
            ],
            'order' => $sort['sort'],
        ]);

        $this->arResult['GRID_LIST'] = $rowFormatter->format($books);
    } else {
        $this->arResult['GRID_LIST'] = [];
    }

    $this->arResult['NAV'] = $nav;
    $this->arResult['UI_FILTER'] = $filterProvider->getFilterFields();
}
```

После этого старые методы `getElementActions()`, `getHeaders()`, `prepareFilter()`, `prepareGridList()` и `getFilterFields()` можно удалить из компонента, потому что их ответственность уехала в фабрики и провайдеры.
