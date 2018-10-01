<h1>記事一覧</h1>
<?= $this->Html->link('Add Article',['action' => 'add']) ?>
<table>
  <tr>
    <th>タイトル</th>
    <th>作成日時</th>
    <th>操作</th>
  </tr>

  <!-- ここで、$articlesクエリーオブジェクトを繰り返して、記事情報を出力します -->
  <!-- Here is where we iterate trough our $articles query object,printing out article info -->

  <?php foreach ($articles as $article): ?>
    <tr>
      <td>
        <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
      </td>
      <td>
        <?= $article->created->format(DATE_RFC850) ?>
      </td>
      <td>
        <?= $this->Html->link('編集', ['action' => 'edit', $article->slug]) ?>
        <?= $this->Form->postLink(
            '削除',
            ['action' => 'delete', $article->slug],
            ['confirm' => '削除してよろしいですか?'])
        ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
