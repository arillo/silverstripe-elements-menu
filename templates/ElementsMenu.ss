<% if $ElementsMenuItems.Exists %>
  <ul>
    <% loop $ElementsMenuItems %>
      <li>
        <a href="#$URLSegment">
          <% if $MenuTitle %>$MenuTitle<% else %>$Title<% end_if %>
        </a>
      </li>
    <% end_loop %>
  </ul>
<% end_if %>
