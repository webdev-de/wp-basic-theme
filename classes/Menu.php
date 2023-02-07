<?php
class Menu
{
    // Class properties declaration
    public string $menuName;
    public int $startAtId;
    public int $depth;
    public array $menuItems = [];
    public array $childItems = [];
    public array $locations;
    public object $menu;
    public array $allMenuItems = [];
    public int $currentPageId;

    // Class constructor 
    public function __construct(string $menu_name, int $start_at_id = 0, int $depth = 0)
    {
        // Assign the given menu name to the class property
        $this->menuName = $menu_name;
        // Assign the given start at id to the class property
        $this->startAtId = $start_at_id;
        // Assign the given depth to the class property
        $this->depth = $depth;
    }

    /**
     * Get all menu items based on the menu name and depth provided
     * @return array The array of menu items
     */

    public function getItems(): array
    {
        // Get all navigation menu locations
        $this->locations = get_nav_menu_locations();

        // Get the menu object based on the menu name
        $this->menu = wp_get_nav_menu_object($this->locations[$this->menuName]);

        // Get all menu items for the menu
        $this->allMenuItems = wp_get_nav_menu_items($this->menu->term_id);

        // Get the ID of the current page
        $this->currentPageId = get_the_ID();

        // Iterate over all menu items
        foreach ($this->allMenuItems as $item) {
            // Create an array for the menu item
            $menu_item = [
                'title' => $item->title,
                'url' => $item->url,
                'id' => $item->ID,
                'parent_id' => $item->menu_item_parent,
                'childs' => [],
                'is_current_page' => ($item->object_id == $this->currentPageId)
            ];

            // Add the menu item to the `menuItems` array if it's a parent item
            if ($item->menu_item_parent == $this->startAtId) {
                $this->menuItems[] = $menu_item;
            } else {
                // Add the menu item to the `childItems` array if it's a child item
                $this->childItems[] = $item;
            }
        }

        // If the depth is greater than 0, get the child items
        if ($this->depth > 0) {
            $this->depth--;
            foreach ($this->menuItems as &$item) {
                $child_menu = new self($this->menuName, $item['id'], $this->depth);
                $item['childs'] = $child_menu->getItems();
            }
        }

        // Return the `menuItems` array
        return $this->menuItems;
    }


    /**
     * Generates the HTML string for the menu structure.
     * @param array $menu_items The menu items to render.
     * @return string The generated HTML string.
     */

    public function render(array $menu_items): string
    {
        // Initialize the HTML string with an unordered list element
        $html = "<ul>";

        // Loop through each menu item
        foreach ($menu_items as $item) {
            // Determine the class for the list item based on if it is the current page
            $activeClass = $item['is_current_page'] ? 'class="active"' : '';

            // Add the list item to the HTML string
            $html .= "<li><a href='" . $item['url'] . "' " . $activeClass . ">" . $item['title'] . " " . $item['id'] . "</a>";

            // If the item has child items, recursively call the render function
            if (!empty($item['childs'])) {
                $html .= $this->render($item['childs']);
            }

            // Close the list item
            $html .= "</li>";
        }

        // Close the unordered list element
        $html .= "</ul>";

        // Return the generated HTML string
        return $html;
    }
}
