Functions example
=================

For further reference, see [GitHub MarkDown guide](https://guides.github.com/features/mastering-markdown/).

Chapter One, basics
-------------------

### Headings and pagebreaks

Note the two different heading styles used in this document. Both are valid according to original MD specification.

---

To create a horizontal line content separator, just write a line of three dashes (`-`), or asterisks (`*`). To force pagebreak, use LaTeX `\pagebreak` command.

***

### Text highlighting
**This text is bold**. Nulla ligula velit, nec ornare felis placerat sed. Morbi accumsan, ligula commodo varius viverra, lectus sem interdum sapien, eget hendrerit velit eros sit amet mi. Fusce convallis est pulvinar, sollicitudin sem eget, suscipit turpis. Vivamus euismod fringilla mauris, vel porta risus porta quis. __This will also be bold__.

*This text is italics*. Praesent ultrices auctor urna, ut scelerisque arcu euismod at. Vivamus odio elit, tempor quis pellentesque at, sodales non dolor. Suspendisse et lobortis urna. _This text is also italics_.

***This text is both bold and italics*** Vestibulum ullamcorper purus nibh, vitae dapibus nisl fermentum et. ___So is this one___.

You can use backticks to emphasize some text, that `ought to be absolutely literal` (mostly in code example comments). a orci bibendum aliquam sit amet nec ex. Nam orci sapien, porttitor a orci eu, hendrerit sodales sem. Quisque pellentesque accumsan nisl id tincidunt. Ut sit amet diam non arcu accumsan gravida non eget erat. Nam sit amet rutrum enim. Nulla mattis ex auctor augue condimentum pharetra. 

~~This text is crossed out~~ et hendrerit magna. Maecenas vel elit at est sagittis mollis. In hac habitasse platea dictumst. Pellentesque in bibendum justo, sed aliquam sem. Vestibulum sollicitudin, tellus ac aliquam hendrerit, dolor tortor tempor eros, nec scelerisque quam mauris id ex.



### Lists

Morbi nec turpis placerat, consectetur sapien nec, consectetur leo. 

This is ordered list example:

1. Sed id tempus turpis
3. Ac sodales risus
10. Pellentesque lobortis eu nibh eget accumsan

It's important to note that the actual numbers you use to mark the list have no effect on the output Markdown produces. It's only about the number-dot sequence. It's also worth noting that it’s possible to trigger an ordered list by accident, for example when beginning a line with a date, in which case you may escape the first dot with a backslash (`\`):

12\.8. something.

Donec id justo et eros facilisis maximus. Mauris sed nisl sed ligula malesuada aliquam at sed sem. Praesent ultricies urna non facilisis egestas. Nunc egestas dolor dictum turpis tincidunt lacinia eu eu neque. Donec gravida feugiat velit, eu bibendum ipsum hendrerit porta. 

There are three ways how to mark an unordered list:

* Integer tristique risus nisi
* Id tincidunt magna hendrerit nec

+  Fusce posuere molestie velit, in pulvinar nibh faucibus nec. 

- Pellentesque finibus placerat dapibus. 
- Integer blandit urna justo

Fusce rhoncus risus vel sem fringilla euismod. Vivamus eu leo rutrum, porta orci quis, sollicitudin lectus. Donec eget mollis elit. Fusce fringilla consequat sapien id cursus. Aenean volutpat, lacus vitae consectetur rutrum, libero enim suscipit tellus. 

This is mixed and nested list example:

1. Phasellus at mollis lectus
	- Egestas fermentum elit
	- Donec aliquam pretium ipsum vitae dignissim. 
2. Fusce commodo ante in dolor commodo eleifend. 
	1. Maecenas iaculis euismod risus
	2. Hendrerit ultrices nisl porta sit amet.
	3. Interdum et malesuada fames ac ante ipsum primis in faucibus. 
		* Nam laoreet magna vel tincidunt porta. Phasellus scelerisque efficitur risus sit amet viverra.
		Nulla ornare a arcu in varius. Fusce at gravida ex. Quisque at ullamcorper leo, a pulvinar nibh. Etiam orci magna, viverra eu mi in, ultricies facilisis metus. 
        * Integer tristique risus nisi 
3. Id tincidunt magna hendrerit nec. Fusce posuere molestie velit, in pulvinar nibh faucibus nec. Pellentesque finibus placerat dapibus. Integer

Quisque luctus cursus mattis. Nunc nec ipsum convallis, vulputate felis quis, pharetra nisl. Phasellus at mollis lectus, egestas fermentum elit. Donec aliquam pretium ipsum vitae dignissim. Proin vel eleifend ante. Fusce commodo ante in dolor commodo eleifend. Maecenas iaculis.

\pagebreak