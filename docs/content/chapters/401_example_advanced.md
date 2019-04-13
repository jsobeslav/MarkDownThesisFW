## Chapter Two, slightly advanced

### Links, notes, and references

You have already seen the link example, when linking to the [GitHub MarkDown guide](https://guides.github.com/features/mastering-markdown/). Another way is using this syntax: <http://example.com/>.


This is how you insert a footnote reference[^1]. Pellentesque enim turpis, tincidunt vel nisl nec, consequat molestie arcu. Donec porta risus risus, vestibulum vestibulum ipsum iaculis vel.

[^1]: This is how you declare footnote contents.
	Etiam luctus urna.

This is how you link to bibliography[@example] Curabitur congue interdum ex a ornare. Some erat volutpat. In nec words orci, ac dapibus eros. Sed mauris mi, ullamcorper eget egestas eu, suscipit vel libero. In augue sapien, ultrices in congue vitae, commodo a purus.



### Images
Nulla lobortis sem non varius pretium. Etiam luctus urna eget lorem posuere, auctor gravida mauris imperdiet. Praesent in porta nibh, eu feugiat mi. Maecenas et risus risus.  Maecenas convallis, risus vel cursus varius. 

This is, how you input an image. The filepath is relative to this MD file and it should also be notet, that the image does not always stay on the declared position, but instead LaTeX moves it to separate page, if necessary due to its size.

**![A magnificent animal](../images/reindeer.jpg)**

Donec euismod massa a magna blandit convallis. Ut vulputate risus augue, ut dictum diam feugiat non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.

### Text blocks
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor ut libero in venenatis. Curabitur maximus dui sit amet aliquet gravida. Aliquam consequat mauris sem, ac elementum arcu vehicula sed. Phasellus non posuere sem.

> **This is how you make a blockquote**
> 
> Etiam sagittis ut nisl ut cursus. Fusce id dapibus lorem, in venenatis nibh. Mauris interdum congue dolor sit amet mollis. Morbi pellentesque tellus et libero pulvinar
> 
> - Author
> 
> Yesteday:
> 
> > **Also, you can nest a blockquote**
> > 
> > Vestibulum consectetur tempor vestibulum
> > 
> > - Also author
>
> A day before yesterday:
>
> > **Also, yo can nest a blockquote**
> > 
> > Vestibulum consectetur tempor vestibulum
> > 
> > - Also author

Sed sed scelerisque nibh. Etiam nec iaculis nisl, quis fringilla metus. Maecenas vel justo id lectus consequat scelerisque. Phasellus ex nibh, congue nec leo sit amet, consequat elementum dui.

```
// You can also input a preformated code block:
main() {
    printf("hello, world");
}
```

Sed mauris mi, ullamcorper eget egestas eu, suscipit vel libero. In augue sapien, ultrices in congue vitae, commodo a purus.

```javascript
// on github, you can specify the language highlighting
if (isAwesome){
  return true
}
```


### Tables

Tables are controlled by pipe character (`|`) denoting a cell boundary, and a line of dashes (`-`) separating the heading. Also, colon (`:`) may denote a column alignment.

| MarkDown | Table | Example |  |
|----------|-------|:-------:|-:|
| Lorem | Ipsum dolorInteger tristique risus nisi, id tincidunt magna hendrerit nec. Fusce posuere molestie velit, in pulvinar nibh faucibus nec. Pellentesque finibus placerat dapibus. | true | 1000 |
| Sit  | Nulla ornare a arcu in varius. Fusce at gravida ex. Quisque at ullamcorper leo, a pulvinar nibh. Etiam orci magna, viverra eu mi in, ultricies facilisis metus | false | 1500 |

It's difficult to write tables like this in hand; that's why there is [Markdown Tables Generator](https://www.tablesgenerator.com/markdown_tables). It's also quite possible, that you might need to constuct more complicated tables, or control their style more, in which case, you'll probably have to write it in LaTeX itself.

Aenean congue risus ante, in malesuada elit sagittis et. Pellentesque ex ex, viverra quis nisl at, tempor venenatis mi. Aliquam erat volutpat. Nunc quis dictum lectus. Nam lacinia pellentesque elit.

\pagebreak