<?php

declare(strict_types=1);

#[Attribute1] #[Attribute2]
#[Attribute3]
class TestClass
{
}

#[Attribute1,Attribute2]
#[Attribute3]
class TestClass2
{
}

#[Attribute1]
#[Attribute2]
#[Attribute3]

class TestClass3
{
}

#[Attribute1]
#[Attribute2]
#[Attribute3]
/** @internal */
class TestClass4
{
}
