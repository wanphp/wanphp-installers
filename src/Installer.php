<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2021/3/31
 * Time: 10:08
 */

namespace Wanphp\ComposerInstallersExtender;


use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
  private $locations = array(
    'libray' => 'wanphp/libray/',
    'plugin' => 'wanphp/plugins/',
    'extend' => 'wanphp/extend/',
    'component' => 'wanphp/components/'
  );

  /**
   * {@inheritDoc}
   */
  public function getPackageBasePath(PackageInterface $package)
  {
    $prefix = substr($package->getPrettyName(), 0, 7);
    if ('wanphp/' === $prefix) {
      $key = substr($package->getType(), 7);
      $path = explode('-', $package->getPrettyName(), 2);
      if (isset($this->locations[$key])) return $this->locations[$key] . $path[1];
      else return 'wanphp/extend/' . $path[1];
    }
    return parent::getPackageBasePath($package);
  }

  public function getInstallPath(PackageInterface $package): string
  {
    $prefix = substr($package->getPrettyName(), 0, 7);
    $this->io->write(sprintf('Install %s - %s', $package->getPrettyName(), $prefix));
    if ('wanphp/' === $prefix) {
      $key = substr($package->getType(), 7);
      $path = explode('-', $package->getPrettyName(), 2);
      $this->io->write($this->locations[$key] . $path[1]);
      if (isset($this->locations[$key])) return $this->locations[$key] . $path[1];
      else return 'wanphp/extend/' . $path[1];
    }
    return parent::getInstallPath($package);
  }

  /**
   * {@inheritDoc}
   */
  public function supports($packageType)
  {
    $this->io->write('Supports' . $packageType);
    $key = substr($packageType, 7);
    return isset($this->locations[$key]);
  }
}
