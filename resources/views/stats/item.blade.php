<tr>
    <th scope="row">{{ $stat['title'] }}</th>
    <td><a {{ isset($stat['href'])?'href=' . $stat['href']:'' }}>{{ $stat['text'] }}</a></td>
</tr>
