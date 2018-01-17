<li><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
<li class="treeview">
	<a href="#">
	  <i class="fa fa-shopping-cart"></i> <span>Ventas</span>
	  <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	  <li><a href="{{route('sale.sell')}}"><i class="fa fa-circle-o"></i>Agregar Venta</a></li>
	  <li><a href="{{route('sale.index')}}"><i class="fa fa-circle-o"></i>Ver Ventas</a></li>
	</ul>
</li>
<li class="treeview">
	<a href="#">
	  <i class="fa fa-shopping-cart"></i> <span>Compras</span>
	  <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	  <li><a href="{{route('buy.make')}}"><i class="fa fa-circle-o"></i>Agregar Compra</a></li>
	  <li><a href="{{route('buy.index')}}"><i class="fa fa-circle-o"></i>Ver Compras</a></li>
	</ul>
</li>
<li class="treeview">
	<a href="#">
	  <i class="fa fa-truck"></i> <span>Proveedores</span>
	  <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	  <li><a href="{{route('providers.create')}}"><i class="fa fa-circle-o"></i>Agregar Proveedor</a></li>
	  <li><a href="{{route('providers.index')}}"><i class="fa fa-circle-o"></i>Ver Proveedores</a></li>
	</ul>
</li>
<li class="treeview">
	<a href="#">
	  <i class="fa fa-file-text-o"></i> <span>Inventario</span>
	  <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	  <li><a href="{{route('stocktaking.create')}}"><i class="fa fa-circle-o"></i>Agregar Producto</a></li>
	  <li><a href="{{route('stocktaking.index')}}"><i class="fa fa-circle-o"></i>Ver Inventario</a></li>
	  <li><a href="{{url('stocktaking/import/view')}}"><i class="fa fa-circle-o"></i>Importar Inventario</a></li>
	</ul>
</li>
<li class="treeview">
	<a href="#">
	  <i class="fa fa-heart-o"></i> <span>Marcas</span>
	  <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	  <li><a href="{{route('trademark.create')}}"><i class="fa fa-circle-o"></i>Agregar Marca</a></li>
	  <li><a href="{{route('trademark.index')}}"><i class="fa fa-circle-o"></i>Ver Marcas</a></li>
	</ul>
</li>
<li class="treeview">
	<a href="#">
	  <i class="fa fa-archive"></i> <span>Grupos</span>
	  <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	  <li><a href="{{route('group.create')}}"><i class="fa fa-circle-o"></i>Agregar Grupo</a></li>
	  <li><a href="{{route('group.index')}}"><i class="fa fa-circle-o"></i>Ver Grupos</a></li>
	</ul>
</li>
<li class="treeview">
	<a href="#">
	  <i class="fa fa-money"></i> <span>Config Porcentajes</span>
	  <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	  <li><a href="{{route('config_currency.create')}}"><i class="fa fa-circle-o"></i>Agregar Porcentaje</a></li>
	  <li><a href="{{route('config_currency.index')}}"><i class="fa fa-circle-o"></i>Ver Porcentajes</a></li>
	</ul>
</li>
<li><a href="{{ route('config.index') }}"><i class="fa fa-cog fa-spin fa-fw"></i> Configuración Global</a></li>

<li><a href="{{ route('sales.import_sale') }}"><i class="fa fa-share" aria-hidden="true"></i> Importar Ventas</a></li>
