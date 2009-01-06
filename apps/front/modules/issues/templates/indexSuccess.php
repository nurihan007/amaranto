<h1>Issues List</h1>

<table class="issues list">
  <thead>
    <tr>
      <th></th>
      <th>Issue</th>
      <th>Title</th>
      <th>Status</th>
      <th>Opened by</th>
      <th>Priority</th>
      <th>Deadline</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($issues as $i => $issue): ?>
    <tr class="<?php echo fmod($i,2) == 0 ? 'even' : 'odd' ?>">
      <td><?php echo $issue['Category']['name'] ?></td>
      <td><?php echo link_to($issue['id'], 'issues_show', $issue) ?></td>
      <td><?php echo link_to($issue['title'], 'issues_show', $issue) ?></td>
      <td><?php echo $issue['Status']['name'] ?></td>
      <td><?php echo $issue['OpenedBy']['username'] ?></td>
      <td><?php echo $issue['Priority']['name'] ?></td>
      <td><?php echo $issue->getdeadline() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('issues_new') ?>">New</a>

