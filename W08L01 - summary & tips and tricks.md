# 💡 summary & tips and tricks

A grab-bag of extras that did not need a full lesson but are worth knowing.

## CSS animations

* Transitions: [MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/Guides/Transitions/Using)
* Keyframe animations: [MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/Guides/Animations/Using)
* Prefer animating `transform` and `opacity` (GPU-composited, cheap) over `width`/`top`/`left`, which
  trigger layout. Respect `@media (prefers-reduced-motion: reduce)` for users who ask for less motion.

```HTML
<div class="loader">
    <div class="dot"></div>
</div>

<!-- Transform animation -->
<style>
.loader {
  width: 60px;
  height: 60px;
  padding: 30px;
  border-radius: 50%;

  transition-duration: 0.8s;
  transition-property: transform;
}

.loader .dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: green;
}

.loader:hover {
    transform: rotate(360deg);
}
</style>

<div class="line-loader">
  This is a long text that will be shown when hovered
</div>

<style>
.line-loader {
    width: 0;
    height: 30px;
    line-height: 30px;
    padding-left: 10px;
    background: red;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;

    transition: width 1.5s ease-in;
}

.line-loader:hover {
    width: 400px;
}
</style>

<div class="wrapper">
    <div class="cube"></div>
</div>

<!-- keyframe animations -->
<style>
.wrapper {
    position: relative;
    width: 100px;
    height: 100px
}

.wrapper .cube {
    display: inline-block;
    width: 10px;
    height: 10px;
    background: red;
    position: absolute;
    left: 0;
    top: 0;
    animation: move 4s infinite;
}

@keyframes move {
    25% {
        left: 100%;
        top: 0;      
    }
    50% {
        left: 100%;
        top: 100%;
    }
    75% {
        top: 100%;
        left: 0;
    }
    100% {
        top: 0;
        left: 0;
    }
}
</style>
```

## iframes

* Embeds another document; sandbox it and be explicit about what it may do.
* [MDN](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/iframe)

```HTML
<iframe src="edit.html" width="400" height="200" loading="lazy" sandbox="allow-scripts"></iframe>
```

## canvas

* Draws 2D/3D graphics from JavaScript; complexity grows fast, so reach for a library (PixiJS, three.js) for anything real.
* [MDN](https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API)
* [Example](local-env-setup/src/W08L01/index.html)

## video

* Native media playback, no plugin. Offer more than one `<source>` format and a captions `<track>`.
* [MDN](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/video)

```HTML
<video controls width="640" preload="metadata" poster="cover.jpg">
    <source src="clip.webm" type="video/webm">
    <source src="clip.mp4" type="video/mp4">
    <track kind="captions" src="clip.en.vtt" srclang="en" label="English">
    Your browser does not support the video tag.
</video>
```

## Doctrine (PHP ORM)

* An ORM maps database rows to typed PHP objects, so you work with objects instead of raw SQL strings (and get prepared statements for free). A repository runs the queries.
* [Doctrine ORM](https://www.doctrine-project.org/projects/orm.html)

```PHP
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private int $id;

    #[ORM\Column(length: 180)]
    private string $email;
}

// Fetching through the repository, no SQL in sight
$user = $entityManager->getRepository(User::class)->find($id);
echo $user->getEmail();
```

## AI with JavaScript

* Build a neural network from scratch in JS: [Neural network from scratch](https://observablehq.com/@mpj/neural-network-from-scratch-part-1)
