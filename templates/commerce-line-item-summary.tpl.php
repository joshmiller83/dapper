<?php

/**
 * @file
 * Default implementation of a line item summary template.
 *
 * Available variables:
 * - $quantity_raw: The number of items in the cart.
 * - $quantity_label: The quantity appropriate label to use for the number of
 *   items in the shopping cart; "item" or "items" by default.
 * - $quantity: A single string containing the number and label.
 * - $total_raw: The raw numeric value of the total value of items in the cart.
 * - $total_label: A text label for the total value; "Total:" by default.
 * - $total: The currency formatted total value of items in the cart.
 * - $links: A rendered links array with cart and checkout links.
 *
 * Helper variables:
 * - $view: The View the line item summary is attached to.
 *
 * @see template_preprocess()
 * @see template_process()
 */
?>
 <a class="line-item-summary" href="<?php print $cart_link; ?>">
  <span class="icon-cart"></span>
  <?php if ($quantity_raw): ?>
    <span class="quantity"><?php print $quantity_raw .' ' . $quantity_label; ?></span>
  <?php endif; ?>
  <em>in your cart</em>
</a>
