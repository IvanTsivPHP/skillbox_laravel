<tr>
    <th scope="row">Всего статей</th>
    <td><a>{{ $stats['getTotalPublishedArticles'] }}</a></td>
</tr>
<tr>
    <th scope="row">Всего новостей</th>
    <td><a>{{ $stats['getTotalPublishedNews'] }}</a></td>
</tr>
<tr>
    <th scope="row">Самый продуктивный автор</th>
    <td><a>{{ $stats['getTotalPublishedNews'] }}</a></td>
</tr>
<tr>
    <th scope="row">Самая большая статья длинной {{ $stats['getBiggestArticle']->len }} </th>
    <td><a href="{{ route('articles', $stats['getBiggestArticle']->id) }}">{{ $stats['getBiggestArticle']->name }}</a></td>
</tr>
<tr>
    <th scope="row">Самая маленькая статья длинной {{ $stats['getSmallestArticle']->len }}</th>
    <td><a href="{{ route('articles', $stats['getSmallestArticle']->id) }}">{{ $stats['getSmallestArticle']->name }}</a></td>
</tr>
<tr>
    <th scope="row">В среднем статей на автора</th>
    <td><a>{{ $stats['getAverageArticlePerActiveUser'] }}</a></td>
</tr>
<tr>
    <th scope="row">Самая редактируемая статья</th>
    <td><a href="{{ route('articles', $stats['getMostChangedArticle']->id) }}">{{ $stats['getMostChangedArticle']->name }}</a></td>
</tr>
<tr>
    <th scope="row">Самая обсуждаемая статья</th>
    <td><a href="{{ route('articles', $stats['getMostDiscussedArticle']->id) }}">{{ $stats['getMostDiscussedArticle']->name }}</a></td>
</tr>
